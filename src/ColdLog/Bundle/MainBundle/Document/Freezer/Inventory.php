<?php

namespace ColdLog\Bundle\MainBundle\Document\Freezer;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;
use ColdLog\Bundle\MainBundle\Document\Box\AbstractBox;

/**
 * @ODM\Document(collection="inventories")
 */
class Inventory
{
    /** @ODM\Id */
    protected $id;

    /** @ODM\ReferenceOne(targetDocument="ColdLog\Bundle\MainBundle\Document\Freezer") */
    protected $freezer;

    /** @ODM\ReferenceOne(targetDocument="ColdLog\Bundle\MainBundle\Document\Freezer\AbstractBox") */
    protected $box;

    /** @ODM\ReferenceOne(targetDocument="ColdLog\Bundle\MainBundle\Document\Freezer\Division") */
    protected $division;

    /** @ODM\Int */
    protected $position;

    /** @ODM\String */
    protected $name;

    /** @ODM\String */
    protected $description;


    public function __construct()
    {
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFreezer(Freezer $freezer)
    {
        $this->freezer = $freezer;
    }

    public function getFreezer()
    {
        return $this->freezer;
    }

    public function setBox(AbstractBox $box)
    {
        $this->box = $box;
    }

    public function getBox()
    {
        return $this->box;
    }

    public function setDivision(Division $division)
    {
        $this->division = $division;
    }

    public function getDivision()
    {
        return $this->division;
    }

    public function setPosition(int $position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
