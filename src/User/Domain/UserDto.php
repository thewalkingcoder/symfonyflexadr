<?php

namespace App\User\Domain;

use App\User\Domain\Entity\User;
use App\User\Domain\Validator\UniqueUserConstraint;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserDto
 *
 * @UniqueUserConstraint()
 */
final class UserDto
{
    /**
     * @Assert\NotBlank(message="Veuillez saisir un nom")
     *
     */
    public $nom;

    private $user;

    public static function createFromUser(User $user): UserDto
    {

        $dto = new self();
        $dto->nom = $user->getNom();
        $dto->user = $user;

        return $dto;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {

        return $this->user;
    }


}