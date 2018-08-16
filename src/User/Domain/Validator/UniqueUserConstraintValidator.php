<?php
namespace App\User\Domain\Validator;

use App\User\Domain\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueUserConstraintValidator extends ConstraintValidator
{
    /**
     * @var \App\User\Domain\UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function validate($value, Constraint $constraint)
    {
        $user = $this->repository->findByUser($value);

        if(empty($user)){
            return true;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ string }}', $value->nom)
            ->addViolation();
    }

}