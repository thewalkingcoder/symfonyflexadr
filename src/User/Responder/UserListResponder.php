<?php

namespace App\User\Responder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class UserListResponder
{
    /**
     * @var \Twig\Environment
     */
    private $twig;
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $request;

    public function __construct(Environment $twig, RequestStack $request)
    {

        $this->twig = $twig;
        $this->request = $request;
    }

    public function __invoke(array $users): Response
    {

        return new Response($this->twig->render('User/list.html.twig', [
          'users' => $users
        ]));
    }
}