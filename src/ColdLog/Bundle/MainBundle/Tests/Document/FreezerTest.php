<?php

namespace ColdLog\Bundle\MainBundle\Tests\Document;

use ColdLog\Bundle\MainBundle\Document\Lab;
use ColdLog\Bundle\MainBundle\Document\User;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;
use Doctrine\Common\Collections\ArrayCollection;
use ColdLog\Bundle\MainBundle\Serializer\Freezer\FreezerSerializer;

class FreezerTest extends \PHPUnit_Framework_TestCase
{
    public function testGettersAndSetters()
    {
        $name = 'freezername';

        $lab = new Lab();

        $description = 'freezer description';
        
        $division1 = new Division();
        $division2 = new Division();
        $divisionCollection = new ArrayCollection();
        $divisionCollection->add($division1);
        $divisionCollection->add($division2);

        $freezer = new Freezer();
        $freezer->setName($name);
        $freezer->setLab($lab);
        $freezer->setDescription($description);
        $freezer->setDivisions($divisionCollection);

        $this->assertEquals($name, $freezer->getName());
        $this->assertEquals($lab, $freezer->getLab());
        $this->assertEquals($description, $freezer->getDescription());
        $this->assertEquals($divisionCollection, $freezer->getDivisions());

        $division3 = new Division();
        $division4 = new Division();
        $divisionArray = array($division3, $division4);

        $divisionCollection->add($division3);
        $divisionCollection->add($division4);

        $freezer->addDivisions($divisionArray);

        $this->assertEquals($divisionCollection, $freezer->getDivisions());
    }

    public function testSerializerKey()
    {
        $freezer = new Freezer();

        $this->assertEquals(FreezerSerializer::getKey(), $freezer->getSerializerKey());
    }
}
