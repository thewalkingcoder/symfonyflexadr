<?php

namespace App\User\Responder;

use App\User\Domain\Entity\User;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class UserUpdateResponder
{
    /**
     * @var \Twig\Environment
     */
    private $twig;
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    public function __construct(Environment $twig, RouterInterface $router)
    {

        $this->twig = $twig;
        $this->router = $router;
    }

    public function __invoke(FormView $formView, Request $request, User $user, $redirect = false): Response
    {
        if($redirect){
            return new RedirectResponse($this->router->generate('app_update_user', ["id" => $user->getId()]));
        }

        return new Response($this->twig->render('User/form.html.twig', [
          'form' => $formView
        ]));
    }
}
