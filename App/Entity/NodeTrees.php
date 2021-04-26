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
     * @return int
     */
    public function getIdNode(): int
    {
        return $this->idNode;
    }

    /**
     * @param int $idNode
     */
    public function setIdNode(int $idNode)
    {
        $this->idNode = $idNode;
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
    public function setLevel(int $level)
    {
        $this->level = $level;
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
    public function setILeft(int $iLeft)
    {
        $this->iLeft = $iLeft;
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
    public function setIRight(int $iRight)
    {
        $this->iRight = $iRight;
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
    public function setNodeTreeNames(array $nodeTreeNames): void
    {
        $this->nodeTreeNames = $nodeTreeNames;
    }


}
