<?php

namespace App\Tests\User\Domain\Validator;

use App\User\Domain\Entity\User;
use App\User\Domain\UserDto;
use App\User\Domain\UserRepository;
use App\User\Domain\Validator\UniqueUserConstraint;
use App\User\Domain\Validator\UniqueUserConstraintValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class UniqueUserConstraintValidatorTest extends ConstraintValidatorTestCase
{

    public function testValidationUserCreated()
    {
        $constraint = new UniqueUserConstraint();
        $this->context = $this->createContext();
        $this->validator = $this->createValidator();
        $this->validator->initialize($this->context);
        $dto = new UserDto();
        $dto->nom = "TEST";
        $this->validator->validate($dto, $constraint);

        $this->assertNoViolation();
    }

    public function testValidationUserExist()
    {
        $constraint = new UniqueUserConstraint();
        $this->context = $this->createContext();
        $user = new User('TEST');
        $this->validator = $this->createValidator([$user]);
        $this->validator->initialize($this->context);
        $dto = new UserDto();
        $dto->nom = "TEST";
        $this->validator->validate($dto, $constraint);

        $this->buildViolation('Le user {{ string }} existe déjà')
             ->setParameter('{{ string }}', 'TEST')
             ->assertRaised();
    }

    protected function createValidator($userList = null)
    {
        $mock = $this->getMockUserRepository($userList);

        return new UniqueUserConstraintValidator($mock);
    }

    protected function getMockUserRepository($userList)
    {
        $mock = $this->createMock(UserRepository::class);
        $mock->method('findByUser')->willReturn($userList);

        return $mock;
    }

}