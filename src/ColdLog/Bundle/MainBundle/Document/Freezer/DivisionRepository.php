<?php

namespace ColdLog\Bundle\MainBundle\Document\Freezer;

use Doctrine\ODM\MongoDB\DocumentRepository;

class DivisionRepository extends DocumentRepository
{
    public function findByFreezer($freezerId)
    {
        return $this->createQueryBuilder()
            ->field('freezer.$id')->equals(new \MongoId($freezerId))
            ->sort('createdAt', 'asc')
            ->getQuery()
            ->execute();
    }
}