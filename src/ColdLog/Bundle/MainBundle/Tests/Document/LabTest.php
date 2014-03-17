<?php

namespace ColdLog\Bundle\MainBundle\Tests\Document;

use ColdLog\Bundle\MainBundle\Document\Lab;
use ColdLog\Bundle\MainBundle\Document\User;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use Doctrine\Common\Collections\ArrayCollection;

class LabTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $name = 'labname';

        $freezer1 = new Freezer();
        $freezer2 = new Freezer();

        $freezerCollection = new ArrayCollection();
        $freezerCollection->add($freezer1);
        $freezerCollection->add($freezer2);
        
        $user1 = new User();
        $user2 = new User();

        $userCollection = new ArrayCollection();
        $userCollection->add($user1);
        $userCollection->add($user2);

        $administrator1 = new User();
        $administrator2 = new User();

        $administratorCollection = new ArrayCollection();
        $administratorCollection->add($administrator1);
        $administratorCollection->add($administrator2);
        
        $lab = new Lab();        

        $lab->setName($name); 
        $lab->setFreezers($freezerCollection);
        $lab->setUsers($userCollection);
        $lab->setAdministrators($administratorCollection);

        $this->assertEquals($name, $lab->getName());
        $this->assertEquals($freezerCollection, $lab->getFreezers());
        $this->assertEquals($userCollection, $lab->getUsers());
        $this->assertEquals($administratorCollection, $lab->getAdministrators());

        $this->assertTrue($lab->isAdministrator($administrator1));
        $this->assertTrue($lab->isAdministrator($administrator2));
        $this->assertFalse($lab->isAdministrator($user1));

        $freezer3     = new Freezer();
        $freezer4     = new Freezer();
        $freezerArray = array($freezer3, $freezer4);
        
        $freezerCollection->add($freezer3);
        $freezerCollection->add($freezer4);
        $lab->addFreezers($freezerArray);
        
        $user3     = new User();
        $user4     = new User();
        $userArray = array($user3, $user4);

        $administrator3     = new User();
        $administrator4     = new User();
        $administratorArray = array($administrator3, $administrator4);

        $administratorCollection->add($administrator3);
        $administratorCollection->add($administrator4);
        $lab->addAdministrators($administratorArray);
        
        $userCollection->add($user3);
        $userCollection->add($user4);
        $lab->addUsers($userArray);

        $this->assertEquals($freezerCollection, $lab->getFreezers());
        $this->assertEquals($userCollection, $lab->getUsers());
        $this->assertEquals($administratorCollection, $lab->getAdministrators());
    }   
}