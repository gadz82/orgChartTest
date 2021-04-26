<?php

namespace App\Repository\CQRS;

interface NodesRepositoryReaderInterface
{

    /**
     * @param int $idNode
     * @param string $language
     * @param string|null $searchKeyword
     * @param int $pageNum
     * @param int $pageSize
     * @return NodeTrees[]
     */
    public function getNodes(int $idNode, string $language, ?string $searchKeyword, int $pageNum = 0, int $pageSize = 100): array;

}
