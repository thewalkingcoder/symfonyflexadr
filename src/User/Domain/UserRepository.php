<?php

namespace App\User\Domain;

use App\User\Domain\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function save(User $user, bool $flush = true)
    {

        $this->_em->persist($user);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function delete(User $user, bool $flush = true)
    {

        $this->_em->remove($user);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function whereIsBryan()
    {

        $qb = $this->createQueryBuilder('u');

        return $qb->getQuery()->getResult();
    }

    public function findByUser(UserDto $dto)
    {
        $qb = $this->createQueryBuilder('u');

        $qb->where('u.nom = :nom');
        $qb->setParameter('nom', $dto->nom);

        $user = $dto->getUser();
        if(!empty($user)){
            $qb->andWhere('u.id != :id');
            $qb->setParameter('id', $user->getId());
        }

        return $qb->getQuery()->getOneOrNullResult();

    }


}