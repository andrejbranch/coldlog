<?php

namespace ColdLog\Bundle\MainBundle\Document\Freezer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Box\AbstractBox;
use ColdLog\Bundle\MainBundle\Serializer\Serializable;
use ColdLog\Bundle\MainBundle\Serializer\Division\DivisionSerializer;

/**
 * @ODM\Document(
 *     collection="divisions",
 *     repositoryClass="ColdLog\Bundle\MainBundle\Document\Freezer\DivisionRepository"
 * )
 */
class Division implements Serializable
{
    /** @ODM\Id */
    protected $id;

    /** @ODM\String */
    protected $name;

    /** @ODM\ReferenceOne(targetDocument="ColdLog\Bundle\MainBundle\Document\Freezer") */
    protected $freezer;

    /** @ODM\ReferenceOne(targetDocument="ColdLog\Bundle\MainBundle\Document\Freezer\Division") */
    protected $parentDivision;

    /** @ODM\ReferenceMany(targetDocument="ColdLog\Bundle\MainBundle\Document\Box\AbstractBox", cascade={"all"}) */
    protected $boxes;

    /** @ODM\Date */
    protected $createdAt;

    public function __construct()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \MongoDate();
        }
        $this->boxes = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setFreezer(Freezer $freezer)
    {
        $this->freezer = $freezer;
    }

    public function getFreezer()
    {
        return $this->freezer;
    }

    public function setParentDivision(Division $division)
    {
        $this->parentDivision = $division;
    }

    public function getParentDivision()
    {
        return $this->parentDivision;
    }

    public function setBoxes(ArrayCollection $boxes)
    {
        $this->boxes = $boxes;
    }

    public function addBoxes(array $boxes)
    {
        foreach ($boxes as $box) {
            if (!$box instanceof AbstractBox) {
                throw new \InvalidArgumentException('You must pass an instance of AbstractBox');
            } else {
                $this->boxes->add($box);
            }
        }
    }

    public function getBoxes()
    {
        return $this->boxes;
    }

    public function getSerializerKey()
    {
        return DivisionSerializer::getKey();
    }
}
