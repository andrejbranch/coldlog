<?php

namespace ColdLog\Bundle\MainBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ColdLog\Bundle\MainBundle\Document\User;

/**
 * @ODM\Document(collection="labs")
 */
class Lab
{
    /** @ODM\Id */
    protected $id;

    /** @ODM\String */
    protected $name;

    /** @ODM\ReferenceMany(targetDocument="ColdLog\Bundle\MainBundle\Document\Freezer") */
    protected $freezers;

    /** @ODM\ReferenceMany(targetDocument="ColdLog\Bundle\MainBundle\Document\Users") */
    protected $users;

    /** @ODM\ReferenceMany(targetDocument="ColdLog\Bundle\MainBundle\Document\Users") */
    protected $administrators;

    public function __construct()
    {
        $this->freezers = new ArrayCollection();
        $this->users    = new ArrayCollection();
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
    
    public function setFreezers(ArrayCollection $freezers)
    {
        $this->freezers = $freezers;
    }

    public function addFreezers(array $freezers)
    {
        foreach ($freezers as $freezer) {
            $this->freezers->add($freezer);
        }
    }

    public function getFreezers()
    {
        return $this->freezers;
    }

    public function setUsers(ArrayCollection $users)
    {
        $this->users = $users;
    }

    public function addUsers(array $users)
    {
        foreach ($users as $user) {
            $this->users->add($user);
        }
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function setAdministrators(ArrayCollection $administrators)
    {
        $this->administrators = $administrators;
    }

    public function addAdministrators(array $administrators)
    {
        foreach ($administrators as $administrator) {
            $this->administrators->add($administrator);
        }
    }

    public function getAdministrators()
    {
        return $this->administrators;
    }

    public function isAdministrator(User $user)
    {
        if ($this->administrators->contains($user)) {
            return true;
        }

        return false;
    }
}
