<?php

namespace ColdLog\Bundle\MainBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ColdLog\Bundle\MainBundle\Document\User;
use ColdLog\Bundle\MainBundle\Document\Lab;
use ColdLog\Bundle\MainBundle\Serializer\Serializable;
use ColdLog\Bundle\MainBundle\Serializer\Freezer\FreezerSerializer;

/**
 * @ODM\Document(collection="freezers")
 */
class Freezer implements Serializable
{
    /** @ODM\Id */
    protected $id;

    /** @ODM\String */
    protected $name;

    /** @ODM\String */
    protected $description;

    /** @ODM\ReferenceOne(targetDocument="ColdLog\Bundle\MainBundle\Document\Lab") */
    protected $lab;

    /** @ODM\ReferenceMany(targetDocument="ColdLog\Bundle\MainBundle\Document\Freezer\Division", cascade={"all"}) */
    protected $divisions;

    /** @ODM\Date */
    protected $createdAt;

    public function __construct()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \MongoDate();
        }
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

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setLab(Lab $lab)
    {
        $this->lab = $lab;
    }

    public function getLab()
    {
        return $this->lab;
    }

    public function setDivisions(ArrayCollection $divisions)
    {
        $this->divisions = $divisions;
    }

    public function addDivisions(array $divisions)
    {
        foreach ($divisions as $division) {
            $this->divisions->add($division);
        }
    }

    public function getDivisions()
    {
        return $this->divisions;
    }

    public function getSerializerKey()
    {
        return FreezerSerializer::getKey();
    }
}
