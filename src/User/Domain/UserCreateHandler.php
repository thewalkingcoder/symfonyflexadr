<?php

namespace App\User\Domain;

use App\User\Domain\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

final class UserCreateHandler implements UserHandlerInterface
{

    private $entityManager;

    public function __construct(ObjectManager $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    public function handle(UserDto $userDto): User
    {
        $user = new User($userDto->nom);
        $this->entityManager->getRepository('User:User')->save($user);

        return $user;
    }

}