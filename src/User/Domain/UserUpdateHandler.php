<?php

namespace App\User\Domain;

final class UserUpdateHandler implements UserHandlerInterface
{

    /**
     * @var \App\User\Domain\UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function handle(UserDto $userDto)
    {
        $user = $userDto->getUser();
        $user->edit($userDto);
        $this->userRepository->save($user);
    }

}