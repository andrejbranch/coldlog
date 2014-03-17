<?php

namespace ColdLog\Bundle\MainBundle\Serializer;

interface Serializable
{
    /**
     * Every serializer should have a key so the ObjectSerializerFactory knows which serialize
     * to use for each object.
     * @return string
     */
    function getSerializerKey();
}