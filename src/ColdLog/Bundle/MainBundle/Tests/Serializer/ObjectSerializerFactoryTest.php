<?php

namespace ColdLog\Bundle\MainBundle\Tests\Serializer;

use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Serializer\Freezer\FreezerSerializer;
use ColdLog\Bundle\MainBundle\Serializer\ObjectSerializerFactory;

class ObjectSerializerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayAndToJson()
    {
        $id1          = (string) new \MongoId();
        $name1        = 'freezer name 1';
        $description1 = 'freezer 1 description';

        $freezer1 = new Freezer();
        $freezer1->setId($id1);
        $freezer1->setName($name1);
        $freezer1->setDescription($description1);

        $id2          = (string) new \MongoId();
        $name2        = 'freezer name 2';
        $description2 = 'freezer 2 description';

        $freezer2 = new Freezer();
        $freezer2->setId($id2);
        $freezer2->setName($name2);
        $freezer2->setDescription($description2);

        $freezerArray = array($freezer1, $freezer2);
        $expectation  = $this->getExpectation($freezerArray);

        $freezerSerializer = new FreezerSerializer();
        $serializerFactory = new ObjectSerializerFactory(array($freezerSerializer));

        $this->assertEquals($expectation, $serializerFactory->toArray($freezerArray));
        $this->assertEquals(json_encode($expectation), $serializerFactory->toJson($freezerArray));
    }

    private function getExpectation($freezers)
    {
        $expectation = array();
        foreach ($freezers as $freezer) {
            $expectation[] = array(
                'id'          => $freezer->getId(),
                'name'        => $freezer->getName(),
                'description' => $freezer->getDescription(),
                'divisions'   => false,
            );
        }

        return $expectation;
    }
}