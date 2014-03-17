<?php

namespace ColdLog\Bundle\MainBundle\Document\Box;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Inventory;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;
use ColdLog\Bundle\MainBundle\Serializer\Serializable;
use ColdLog\Bundle\MainBundle\Serializer\Box\BoxSerializer;

/**
 * @ODM\Document(
 *     collection="boxes",
 *     repositoryClass="ColdLog\Bundle\MainBundle\Document\Box\BoxRepository"
 * )
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField(fieldName="type")
 * @ODM\DiscriminatorMap({
 *     "8 x 8"   = "ColdLog\Bundle\MainBundle\Document\Box\EightByEightBox",
 *     "10 x 10" = "ColdLog\Bundle\MainBundle\Document\Box\TenByTenBox",
 * })
 */
abstract class AbstractBox implements Serializable
{
    /** @ODM\Id */
    protected $id;

    /** @ODM\String */
    protected $name;

    /** @ODM\ReferenceOne(targetDocument="ColdLog\Bundle\MainBundle\Document\Freezer") */
    protected $freezer;

    /** @ODM\ReferenceOne(targetDocument="ColdLog\Bundle\MainBundle\Document\Freezer\Division") */
    protected $division;

    /** @ODM\ReferenceMany(targetDocument="ColdLog\Bundle\MainBundle\Document\Freezer\Inventory") */
    protected $inventories;

    /** @ODM\Date */
    protected $createdAt;

    abstract public function getType();

    public function __construct()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \MongoDate();
        }
        $this->inventories = new ArrayCollection();
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

    public function setDivision(Division $division)
    {
        $this->division = $division;
    }

    public function getDivision()
    {
        return $this->division;
    }

    public function setInventories(ArrayCollection $inventories)
    {
        $this->inventories = $inventories;
    }

    public function addInventories(array $inventories)
    {
        foreach ($inventories as $inventory) {
            if (!$inventory instanceof Inventory) {
                throw new \InvalidArgumentException('You can only add an instance of class Inventory');
            } else {
                $this->inventories->add($inventory);
            }
        }
    }

    public function getInventories()
    {
        return $this->inventories;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSerializerKey()
    {
        return BoxSerializer::getKey();
    }
}
