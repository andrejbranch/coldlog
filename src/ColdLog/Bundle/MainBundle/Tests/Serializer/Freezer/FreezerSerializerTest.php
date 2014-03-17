<?php

namespace ColdLog\Bundle\MainBundle\Tests\Serializer\Freezer;

use ColdLog\Bundle\MainBundle\Serializer\Freezer\FreezerSerializer;
use ColdLog\Bundle\MainBundle\Document\Freezer;

class FreezerSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayAndToJson()
    {
        $id          = (string) new \MongoId();
        $name        = 'freezer name';
        $description = 'freezer description';

        $freezer = new Freezer();
        $freezer->setId($id);
        $freezer->setName($name);
        $freezer->setDescription($description);

        $expectation = array(
            'id'          => $id,
            'name'        => $name,
            'description' => $description,
            'divisions'   => false,
        );

        $serializer  = new FreezerSerializer();

        $this->assertEquals($expectation, $serializer->toArray($freezer));
        $this->assertEquals(json_encode($expectation), $serializer->toJson($freezer));
    }
}
