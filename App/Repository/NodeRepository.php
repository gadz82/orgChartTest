<?php
namespace App\Repository;

use App\Repository\CQRS\NodesRepositoryReaderInterface;
use App\Repository\CQRS\RepositoryInterface;
use App\Repository\CQRS\RepositoryReaderInterface;

class NodesRepository implements RepositoryInterface, RepositoryReaderInterface , NodesRepositoryReaderInterface {

    use RepositoryConnectionSingletonTrait;

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
        $sql = "
            SELECT
                   n.idNode,
                   n.iLeft,
                   n.iRight
            FROM
                 node_tree as n,
                 node_tree as np
            WHERE
                n.level = np.level + 1
            AND
                n.iLeft > np.iLeft
            AND
                n.iRight < np.iRight
            AND
                n.level = 1

        ";
    }

}
