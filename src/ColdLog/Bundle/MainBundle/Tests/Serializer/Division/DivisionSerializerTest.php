<?php

namespace ColdLog\Bundle\MainBundle\Tests\Serializer\Division;

use ColdLog\Bundle\MainBundle\Serializer\Division\DivisionSerializer;
use ColdLog\Bundle\MainBundle\Document\Box\TenByTenBox;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;

class DivisionSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayAndToJson()
    {
        $id        = (string) new \MongoId();
        $name      = 'box name';
        $freezerId = (string) new \MongoId();

        $freezer = new Freezer();
        $freezer->setId($freezerId);
        
        $box = new TenByTenBox();

        $division = new Division();
        $division->setId($id);
        $division->setName($name);
        $division->addBoxes(array($box));
        $division->setFreezer($freezer);

        $expectation = array(
            'id'        => $id,
            'name'      => $name,
            'freezerId' => $freezerId,
            'parentId'  => null,
            'hasBoxes'  => true,
        );

        $serializer  = new DivisionSerializer();

        $this->assertEquals($expectation, $serializer->toArray($division));
        $this->assertEquals(json_encode($expectation), $serializer->toJson($division));
    }
}
