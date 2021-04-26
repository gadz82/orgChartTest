<?php
namespace App\Repository;

use App\Library\Db;
use App\Repository\CQRS\NodesRepositoryReaderInterface;
use App\Repository\CQRS\RepositoryInterface;
use App\Repository\CQRS\RepositoryReaderInterface;
use mysqli;

class NodesRepository implements RepositoryInterface, RepositoryReaderInterface , NodesRepositoryReaderInterface {

    /**
     * @param int $idNode
     * @param string $language
     * @param string|null $searchKeyword
     * @param int|null $pageNum
     * @param int|null $pageSize
     * @return NodeTrees[]
     */
    public function getNodes(int $idNode, string $language, ?string $searchKeyword, ?int $pageNum = 0, ?int $pageSize = 100): array
    {
        /**
         * @var mysqli $db
         */
        $db = Db::getInstance();
        $sqlStatement = "
            SELECT SELECT FOUND_ROWS()
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
              node_tree as np,
              node_tree as n
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

        if(!is_null($searchKeyword)){
            $sqlStatement.= "
                AND ntm.nodeName LIKE ?;
            ";
            $bindTypes.= 's';
            $bindParams = "%$searchKeyword%";
        }

        $sqlStatement.= "
            LIMIT ?, OFFSET ?
        ";
        $offset = $pageNum*$pageSize;

        $bindTypes.= 'ii';
        $bindParams[] = $pageSize;
        $bindParams[] = $offset;

        $stmt = $db->prepare($sqlStatement);
        $stmt->bind_param($bindTypes, $bindParams);


    }

    public static function getLanguageEnumValues(){
        /**
         * @var mysqli $db
         */
        $db = Db::getInstance();
        $type = $db->query( "SHOW COLUMNS FROM node_tree_names WHERE language = 'language'" )->fetch_object()->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        return explode("','", $matches[1]);
    }

}


