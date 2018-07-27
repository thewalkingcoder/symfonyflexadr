<?php

namespace App\User\Domain;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function whereIsBryan()
    {
        $qb = $this->createQueryBuilder('u');

        return $qb->getQuery()->getResult();
    }

}