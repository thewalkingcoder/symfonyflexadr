<?php

namespace App\User\Domain\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\User\Domain\UserRepository")
 */
class User
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="nom")
     */
    private $nom;

    /**
     * @return mixed
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {

        return $this->nom;
    }



}