<?php

namespace App\Entity;

use App\Entity\Model\EntityInterface;

/**
 * Class NodeTreeNames
 * @package App\Entity
 */
class NodeTreeNames implements EntityInterface
{

    /**
     * @var int
     */
    private $idNode;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $nodeName;

    /**
     * @var NodeTrees[]
     */
    private $nodeTrees;

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
    public function setIdNode(int $idNode): NodeTreeNames
    {
        $this->idNode = $idNode;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): NodeTreeNames
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getNodeName(): string
    {
        return $this->nodeName;
    }

    /**
     * @param string $nodeName
     */
    public function setNodeName(string $nodeName): NodeTreeNames
    {
        $this->nodeName = $nodeName;
        return $this;
    }

    /**
     * @return NodeTrees[]
     */
    public function getNodeTrees(): array
    {
        return $this->nodeTrees;
    }

    /**
     * @param NodeTrees[] $nodeTrees
     */
    public function setNodeTrees(array $nodeTrees): NodeTreeNames
    {
        $this->nodeTrees = $nodeTrees;
        return $this;
    }

}
