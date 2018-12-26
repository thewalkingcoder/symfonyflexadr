<?php

namespace App\User\Action;

use App\User\Domain\UserFormType;
use App\User\Domain\UserHandlerInterface;
use App\User\Responder\UserCreateResponder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserCreateAction
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
      UserHandlerInterface $userCreateHandler,
      UserCreateResponder $responder
    ) {

        $this->formFactory = $formFactory;
        $this->responder = $responder;
        $this->handler = $userCreateHandler;

    }

    /**
     * @Route("/create", name="app_create_user")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function __invoke(Request $request)
    {

        $form = $this->formFactory->create(UserFormType::class);
        $form->handleRequest($request);
        $responder = $this->responder;
        $redirect = false;

        if($form->isSubmitted() && $form->isValid()){
            /** @var \Symfony\Component\HttpFoundation\Session\Session $session */
            $session = $request->getSession();
            $this->handler->handle($form->getData());
            $redirect = true;
            $session->getFlashBag()->add('success','Enregistrement effectué');
        }


        return $responder($form->createView(), $request, $redirect);
    }
}