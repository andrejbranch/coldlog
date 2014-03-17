<?php

namespace ColdLog\Bundle\MainBundle\Document\Box;

use Doctrine\ODM\MongoDB\DocumentRepository;

class BoxRepository extends DocumentRepository
{
    public function findByDivision($divisionId)
    {
        return $this->createQueryBuilder()
            ->field('division.id')->equals($divisionId)
            ->sort('createdAt', 'desc')
            ->getQuery()
            ->execute();
    }
}