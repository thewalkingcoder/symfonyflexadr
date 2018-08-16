<?php

namespace App\User\Action;

use App\User\Domain\Entity\User;
use App\User\Domain\UserDeleteHandler;
use App\User\Responder\UserDeleteResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class UserDeleteAction
{

    /**
     * @var \App\User\Domain\UserHandlerInterface
     */
    private $userDeleteHandler;
    /**
     * @var \App\User\Responder\UserDeleteResponder
     */
    private $responder;


    public function __construct(
      UserDeleteHandler $userDeleteHandler,
      UserDeleteResponder $responder
    ) {

        $this->userDeleteHandler = $userDeleteHandler;
        $this->responder = $responder;
    }

    /**
     * @Route("/delete/{id}", name="app_delete_user")
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     */
    public function __invoke(Request $request, User $user)
    {

        $this->userDeleteHandler->handle($user);
        $responder = $this->responder;

        return $responder();
    }
}