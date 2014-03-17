<?php

namespace ColdLog\Bundle\MainBundle\Serializer;

interface Serializer
{
    /**
    * Converts a given object instance to an array.
    *
    * @param object $object
    * @return array
    */
    function toArray($object);

    /**
    * Converts a given object instance to json.
    *
    * @param object $object
    * @return json 
    */
    function toJson($object);

    /**
    * Every serializer must have unique key that can be accessed statically.
    * This allows documents and entities to have a getSerializerKey method which
    * allows ObjectSerializerFactory to easily loop through objects and pass the object
    * to its corresponding serializer.
    *
    * @return string 
    */
    public static function getKey();
}