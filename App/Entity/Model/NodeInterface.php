<?php

namespace App\Entity\Model;

use App\Entity\EntityAbstract;

interface NodeInterface
{
    /**
     * @param int $childCount
     * @return int
     */
    function setChildCount(int $childCount): NodeInterface;

    /**
     * @return int
     */
    function getChildCount(): int;

}
