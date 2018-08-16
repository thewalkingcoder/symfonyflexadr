<?php

namespace App\User\Domain\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class UniqueUserConstraint
 *
 * @Annotation
 */
class UniqueUserConstraint extends Constraint
{
    public $message = 'Le user {{ string }} existe déjà';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}