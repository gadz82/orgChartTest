<?php
namespace App\Entity;

class NodeTreeNames implements EntityInterface{

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
    public function setIdNode(int $idNode)
    {
        $this->idNode = $idNode;
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
    public function setLanguage(string $language): void
    {
        $this->language = $language;
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
    public function setNodeName(string $nodeName): void
    {
        $this->nodeName = $nodeName;
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
    public function setNodeTrees(array $nodeTrees): void
    {
        $this->nodeTrees = $nodeTrees;
    }

}
