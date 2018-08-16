<?php

namespace App\User\Action;

use App\User\Domain\Entity\User;
use App\User\Domain\UserDto;
use App\User\Domain\UserFormType;
use App\User\Domain\UserHandlerInterface;
use App\User\Responder\UserCreateResponder;
use App\User\Responder\UserUpdateResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserUpdateAction
{


    /**
     * @var \Symfony\Component\Form\FormFactory
     */
    private $formFactory;
    /**
     * @var \App\User\Responder\UserCreateResponder
     */
    private $responder;
    /**
     * @var \App\User\Domain\UserCreateHandler
     */
    private $handler;

    public function __construct(
      FormFactoryInterface $formFactory,
      UserHandlerInterface $userUpdateHandler,
      UserUpdateResponder $responder
    ) {


        $this->formFactory = $formFactory;
        $this->responder = $responder;
        $this->handler = $userUpdateHandler;
    }

    /**
     * @Route("/update/{id}", name="app_update_user")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\User\Domain\Entity\User              $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request, User $user)
    {

        $userDto = UserDto::createFromUser($user);
        $form = $this->formFactory->create(UserFormType::class, $userDto);
        $responder = $this->responder;
        $form->handleRequest($request);
        $redirect = false;

        if($form->isSubmitted() && $form->isValid()){

            $this->handler->handle($form->getData());
            $session = $request->getSession();
            $redirect = true;
            $session->getFlashBag()->add("success", "Modification réalisée");
        }

        return $responder($form->createView(), $request, $user, $redirect);
    }
}