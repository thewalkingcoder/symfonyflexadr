<?php

namespace App\User\Responder;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

final class UserDeleteResponder
{

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {

        $this->router = $router;
    }

    public function __invoke()
    {
        return new RedirectResponse($this->router->generate('app_index'));
    }
}