<?php

namespace ColdLog\Bundle\MainBundle\Serializer\Box;

use ColdLog\Bundle\MainBundle\Serializer\Serializer;
use ColdLog\Bundle\MainBundle\Document\Box\AbstractBox;

class BoxSerializer implements Serializer
{
    const KEY = 'box';

    public function toArray($box)
    {
        return array(
            'id'         => $box->getId(),
            'name'       => $box->getName(),
            'height'     => $box->getHeight(),
            'width'      => $box->getWidth(),
            'divisionId' => $box->getDivision() ? $box->getDivision()->getId() : null,
            'freezerId'  => $box->getFreezer() ? $box->getFreezer()->getId() : null,
        );
    }

    public function toJson($box)
    {
        return json_encode($this->toArray($box));
    }

    public static function getKey() {
        return self::KEY;
    }
}