<?php

namespace ColdLog\Bundle\MainBundle\Tests\Document\Freezer;

use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;
use ColdLog\Bundle\MainBundle\Document\Box\EightByEightBox;
use ColdLog\Bundle\MainBundle\Document\Freezer\Inventory;

class InventoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $id          = (string) new \MongoId();
        $name        = 'inventory name';
        $description = 'description';
        
        $freezer  = new Freezer();
        $box      = new EightByEightBox();
        $division = new Division();

        $inventory = new Inventory();
        $inventory->setId($id);
        $inventory->setName($name);
        $inventory->setDescription($description);
        $inventory->setFreezer($freezer);
        $inventory->setBox($box);
        $inventory->setDivision($division);

        $this->assertEquals($id, $inventory->getId());
        $this->assertEquals($name, $inventory->getName());
        $this->assertEquals($box, $inventory->getBox());
        $this->assertEquals($division, $inventory->getDivision());
        $this->assertEquals($description, $inventory->getDescription());
    }
}