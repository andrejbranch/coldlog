<?php

namespace ColdLog\Bundle\MainBundle\Serializer\Freezer;

use ColdLog\Bundle\MainBundle\Serializer\Serializer;
use ColdLog\Bundle\MainBundle\Document\Freezer;

class FreezerSerializer implements Serializer
{
    const KEY = 'freezer';

    public function toArray($freezer)
    {
        return array(
            'id'          => $freezer->getId(),
            'name'        => $freezer->getName(),
            'description' => $freezer->getDescription(),
            'divisions'   => $this->hasDivisions($freezer)
        );
    }

    public function toJson($freezer)
    {
        return json_encode($this->toArray($freezer));
    }

    public static function getKey() {
        return self::KEY;
    }

    private function hasDivisions($freezer)
    {
        return count($freezer->getDivisions()) != 0;
    }
}