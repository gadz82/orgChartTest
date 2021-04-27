<?php

namespace App\Entity;

use App\Entity\Model\EntityInterface;
use App\Entity\Model\NodeInterface;

class NodeTrees implements EntityInterface, NodeInterface
{

    /**
     * @var int
     */
    private $idNode;

    /**
     * @var int
     */
    private $level;

    /**
     * @var int
     */
    private $iLeft;

    /**
     * @var int
     */
    private $iRight;

    /**
     * @var NodeTreeNames[]
     */
    private $nodeTreeNames;

    /**
     * @var
     */
    private $childCount;

    /**
     * @return int
     */
    public function getIdNode(): int
    {
        return $this->idNode;
    }

    /**
     * @param int $idNode
     */
    public function setIdNode(int $idNode): NodeTrees
    {
        $this->idNode = $idNode;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): NodeTrees
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return int
     */
    public function getILeft(): int
    {
        return $this->iLeft;
    }

    /**
     * @param int $iLeft
     */
    public function setILeft(int $iLeft): NodeTrees
    {
        $this->iLeft = $iLeft;
        return $this;
    }

    /**
     * @return int
     */
    public function getIRight(): int
    {
        return $this->iRight;
    }

    /**
     * @param int $iRight
     */
    public function setIRight(int $iRight): NodeTrees
    {
        $this->iRight = $iRight;
        return $this;
    }

    /**
     * @return NodeTreeNames[]
     */
    public function getNodeTreeNames(): array
    {
        return $this->nodeTreeNames;
    }

    /**
     * @param NodeTreeNames[] $nodeTreeNames
     */
    public function setNodeTreeNames(array $nodeTreeNames): NodeTrees
    {
        $this->nodeTreeNames = $nodeTreeNames;
        return $this;
    }

    /**
     * @return int
     */
    function getChildCount(): int
    {
        return $this->childCount;
    }

    /**
     * @param int $childCount
     * @return NodeInterface
     */
    function setChildCount(int $childCount): NodeInterface
    {
        $this->childCount = $childCount;
        return $this;
    }
}
