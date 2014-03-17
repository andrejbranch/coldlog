<?php

namespace ColdLog\Bundle\MainBundle\Tests\Document\Freezer;

use ColdLog\Bundle\MainBundle\Document\Lab;
use ColdLog\Bundle\MainBundle\Document\User;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;
use ColdLog\Bundle\MainBundle\Document\Box\EightByEightBox;
use ColdLog\Bundle\MainBundle\Document\Box\TenByTenBox;
use Doctrine\Common\Collections\ArrayCollection;

class DivisionTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $id   = (string) new \MongoId();
        $name = 'division name';

        $freezer = new Freezer();

        $box1 = new EightByEightBox();
        $box2 = new TenByTenBox();
        $boxCollection = new ArrayCollection();

        $division = new Division();
        $division->setId($id);
        $division->setName($name);
        $division->setFreezer($freezer);
        $division->setBoxes($boxCollection);

        $this->assertEquals($id, $division->getId());
        $this->assertEquals($name, $division->getName());
        $this->assertEquals($freezer, $division->getFreezer());
        $this->assertEquals($boxCollection, $division->getBoxes());

        $box3 = new EightByEightBox();
        $box4 = new TenByTenBox();
        $boxArray = array($box3, $box4);

        $boxCollection->add($box3);
        $boxCollection->add($box4);

        $division->addBoxes($boxArray);

        $this->assertEquals($boxCollection, $division->getBoxes());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddBoxThrowsException()
    {
        $box = array('something');
        $division = new Division(); 
        $division->addBoxes($box);
    }
}