<?php

namespace ColdLog\Bundle\MainBundle\Tests\Document\Freezer;

use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Inventory;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;
use ColdLog\Bundle\MainBundle\Document\Box\TenByTenBox;
use Doctrine\Common\Collections\ArrayCollection;

class TenByTenBoxTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $id   = (string) new \MongoId();
        $name = 'box name';

        $freezer    = new Freezer();
        $division   = new Division();
        $inventory1 = new Inventory();
        $inventory2 = new Inventory();
        $inventoryCollection = new ArrayCollection();
        $inventoryCollection->add($inventory1);
        $inventoryCollection->add($inventory2);

        $box = new TenByTenBox();
        $box->setId($id);
        $box->setFreezer($freezer);
        $box->setDivision($division);
        $box->setInventories($inventoryCollection);

        $this->assertEquals($id, $box->getId());
        $this->assertEquals($freezer, $box->getFreezer());
        $this->assertEquals($division, $box->getDivision());
        $this->assertEquals($inventoryCollection, $box->getInventories());

        $inventory3 = new Inventory();
        $inventory4 = new Inventory();
        $inventoryArray = array($inventory3, $inventory4);

        $inventoryCollection->add($inventory3, $inventory4);

        $box->addInventories($inventoryArray);

        $this->assertEquals($inventoryCollection, $box->getInventories());
    }

    public function testGetType()
    {
        $box = new TenByTenBox();
        $this->assertEquals('10 x 10', $box->getType());
    }

    public function testGetWidthAndHeight()
    {
        $box = new TenByTenBox();
        $this->assertEquals(10, $box->getWidth());
        $this->assertEquals(10, $box->getHeight());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddInventoryThrowsException()
    {
        $inventory = array('something');
        $box = new TenByTenBox(); 
        $box->addInventories($inventory);
    }
}