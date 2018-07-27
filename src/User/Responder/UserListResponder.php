<?php

namespace App\User\Responder;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class UserListResponder
{
    /**
     * @var \Twig\Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {

        $this->twig = $twig;
    }

    public function __invoke(array $users): Response
    {

        return new Response($this->twig->render('User/list.html.twig', [
          'users' => $users
        ]));
    }
}