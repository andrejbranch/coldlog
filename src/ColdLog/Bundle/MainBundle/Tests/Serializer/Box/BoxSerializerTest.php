<?php

namespace ColdLog\Bundle\MainBundle\Tests\Serializer\Box;

use ColdLog\Bundle\MainBundle\Serializer\Box\BoxSerializer;
use ColdLog\Bundle\MainBundle\Document\Box\TenByTenBox;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;

class BoxSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayAndToJson()
    {
        $id         = (string) new \MongoId();
        $freezerId  = (string) new \MongoId();
        $divisionId = (string) new \MongoId();
        $name       = 'box name';

        $freezer = new Freezer();
        $freezer->setId($freezerId);
        
        $division = new Division();
        $division->setId($divisionId);
        
        $box = new TenByTenBox();
        $box->setId($id);
        $box->setName($name);
        $box->setFreezer($freezer);
        $box->setDivision($division);

        $expectation = array(
            'id'         => $id,
            'name'       => $name,
            'height'     => 10,
            'width'      => 10,
            'divisionId' => $divisionId,
            'freezerId'  => $freezerId,
        );

        $serializer  = new BoxSerializer();

        $this->assertEquals($expectation, $serializer->toArray($box));
        $this->assertEquals(json_encode($expectation), $serializer->toJson($box));
    }
}
