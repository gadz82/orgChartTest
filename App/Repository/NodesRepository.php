<?php

namespace App\Repository;

use App\Entity\NodeTreeNames;
use App\Entity\NodeTrees;
use App\Library\Db;
use App\Repository\CQRS\NodesRepositoryReaderInterface;
use mysqli;

class NodesRepository implements NodesRepositoryReaderInterface
{

    public static function getLanguageEnumValues()
    {
        /**
         * @var mysqli $db
         */
        $db = Db::getInstance();
        $type = $db->query("SHOW COLUMNS FROM node_tree_names WHERE Field = 'language'")->fetch_object()->Type;
        preg_match("/^enum\('(.*)'\)$/", $type, $matches);
        return explode("','", $matches[1]);
    }

    /**
     * @param int $idNode
     * @param string $language
     * @param string|null $searchKeyword
     * @param int|null $pageNum
     * @param int|null $pageSize
     * @return NodeTrees[]
     */
    public function getNodes(int $idNode, string $language, int $pageNum, int $pageSize, ?string $searchKeyword = null): array
    {
        /**
         * @var mysqli $db
         */
        $db = Db::getInstance();
        $sqlStatement = "
            SELECT
              n.idNode,
              n.`level`,
              n.iLeft,
              n.iRight,
              (
               SELECT
                 COUNT(*)
               FROM
                 node_tree nc
               WHERE
                 nc.level = n.level+1
               AND
                 nc.iLeft > n.iLeft
               AND
                 nc.iRight < n.iRight
              ) AS childCount,
              ntm.language,
              ntm.`nodeName`
            FROM
              node_tree as np, node_tree as n
            INNER JOIN node_tree_names ntm ON ntm.`idNode` = n.`idNode`
            WHERE
              n.level = np.level + 1
            AND
              n.iLeft > np.iLeft
            AND
              n.iRight < np.iRight
            AND
              np.idNode = ?
            AND
              ntm.`language` = ?";


        $bindTypes = 'is';
        $bindParams[] = $idNode;
        $bindParams[] = $language;

        if (!is_null($searchKeyword)) {

            $sqlStatement .= "
                AND ntm.nodeName COLLATE UTF8_GENERAL_CI LIKE ?
            ";

            $bindTypes .= 's';
            $bindParams[] = "%" . $searchKeyword . "%";

        }

        $sqlStatement .= "
            LIMIT ? OFFSET ?
        ";
        $offset = $pageNum > 0 ? $pageNum * $pageSize : 0;

        $bindTypes .= "ii";
        $bindParams[] = $pageSize;
        $bindParams[] = $offset;
        $stmt = $db->prepare($sqlStatement);

        $stmt->bind_param($bindTypes, ...$bindParams);
        $stmt->execute();
        $result = $stmt->get_result();
        $return = [];
        while ($node = $result->fetch_object()) {
            $nodeTree = new NodeTrees();
            $nodeTree->setIdNode($node->idNode)
                ->setILeft($node->iLeft)
                ->setIRight($node->iRight)
                ->setLevel($node->level)
                ->setChildCount($node->childCount);

            $nodeTreeName = new NodeTreeNames();
            $nodeTreeName->setIdNode($node->idNode)
                ->setLanguage($node->language)
                ->setNodeName($node->nodeName);
            $nodeTreeNames = [$nodeTreeName];

            $nodeTree->setNodeTreeNames($nodeTreeNames);

            $return[] = $nodeTree;
        }

        return $return;

    }

}


