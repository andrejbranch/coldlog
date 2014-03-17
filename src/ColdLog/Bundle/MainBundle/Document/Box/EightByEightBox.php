<?php

namespace ColdLog\Bundle\MainBundle\Document\Box;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;

/**
 * @ODM\Document
 */
class EightByEightBox extends AbstractBox
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getType()
    {
        return '8 x 8';
    }

    public function getWidth()
    {
        return 8;
    }

    public function getHeight()
    {
        return 8;
    }
}