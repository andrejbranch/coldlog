<?php

namespace ColdLog\Bundle\MainBundle\Serializer\Division;

use ColdLog\Bundle\MainBundle\Serializer\Serializer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;

class DivisionSerializer implements Serializer
{
    const KEY = 'division';

    public function toArray($division)
    {
        $freezer = $division->getFreezer();
        $parent  = $division->getParentDivision();
        return array(
            'id'        => $division->getId(),
            'name'      => $division->getName(),
            'freezerId' => $freezer ? $freezer->getId() : null,
            'parentId'  => $parent ? $parent->getId() : null,
            'hasBoxes'  => $this->hasBoxes($division),
        );
    }

    public function toJson($division)
    {
        return json_encode($this->toArray($division));
    }

    public static function getKey() {
        return self::KEY;
    }

    public function hasBoxes($division)
    {
        return count($division->getBoxes()) != 0;
    }
}