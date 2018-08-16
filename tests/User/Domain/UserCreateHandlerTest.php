<?php

namespace App\Tests\User\Domain;

use App\User\Domain\Entity\User;
use App\User\Domain\UserCreateHandler;
use App\User\Domain\UserDto;
use App\User\Domain\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserCreateHandlerTest extends TestCase
{

    public function testHandle()
    {

        $handler = new UserCreateHandler($this->getMockEntityManager());
        $userDto = new UserDto();
        $userDto->nom = "RICK";

        $user = $handler->handle($userDto);

        $this->assertSame("RICK", $user->getNom());
        $this->assertInstanceOf(User::class, $user);
    }

    private function getMockEntityManager()
    {

        $repository = $this->createMock(UserRepository::class);
        $em = $this->createMock(ObjectManager::class);
        $em->method("getRepository")->willReturn($repository);

        return $em;
    }

}