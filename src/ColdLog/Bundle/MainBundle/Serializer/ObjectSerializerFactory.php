<?php

namespace ColdLog\Bundle\MainBundle\Serializer;

use ColdLog\Bundle\MainBundle\Serializer\Serializable;
use ColdLog\Bundle\MainBundle\Serializer\Serializer;

class ObjectSerializerFactory
{
    private $serializers;

    public function __construct(array $serializers)
    {
        foreach ($serializers as $serializer) {
            if ($serializer instanceof Serializer) {
                $this->serializers[$serializer->getKey()] = $serializer;
            } else {
                throw new \InvalidArgumentException(sprintf('Class %s must implement ColdLog\Bundle\MainBundle\Serializer\Serializer interface', get_class($serializer)));
            }
        }
    }

    public function toArray($serializables)
    {
        $result = array();
        foreach ($serializables as $serializable) {
            if (!($serializable instanceof Serializable)) {
                throw new \InvalidArgumentException(sprintf('Class %s must implement ColdLog\Bundle\MainBundle\Serializer\Serializable interface', get_class($serializable)));
            }

            $result[] = $this->serializers[$serializable->getSerializerKey()]->toArray($serializable);
        }

        return $result;
    }

    public function toJson($serializables)
    {
        $result = array();
        foreach ($serializables as $serializable) {
            if (!($serializable instanceof Serializable)) {
                throw new \InvalidArgumentException(sprintf('Class %s must implement ColdLog\Bundle\MainBundle\Serializer\Serializable interface', get_class($serializable)));
            }

            $result[] = $this->serializers[$serializable->getSerializerKey()]->toArray($serializable);
        }

        return json_encode($result);
    }
}