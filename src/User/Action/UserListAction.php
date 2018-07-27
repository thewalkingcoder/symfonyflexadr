<?php

namespace App\User\Action;

use App\User\Responder\UserListResponder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserListAction
{
    private $responder;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;


    public function __construct(UserListResponder $responder, EntityManagerInterface $entityManager)
    {

        $this->responder = $responder;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="app_index")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return mixed
     *
     */
    public function __invoke(Request $request)
    {
        $users = $this->entityManager->getRepository('User:User')->whereIsBryan();
        $responder = $this->responder;
        return $responder($users);
    }
}