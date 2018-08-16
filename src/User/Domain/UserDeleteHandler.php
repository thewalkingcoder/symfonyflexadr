<?php

namespace App\User\Domain;

use App\User\Domain\Entity\User;

final class UserDeleteHandler
{

    /**
     * @var \App\User\Domain\UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {

        $this->repository = $repository;
    }

    public function handle(User $user)
    {

        $this->repository->delete($user);
    }

}