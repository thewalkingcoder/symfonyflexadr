<?php

namespace App\User\Domain;

interface UserHandlerInterface
{
    public function handle(UserDto $userDto);
}

