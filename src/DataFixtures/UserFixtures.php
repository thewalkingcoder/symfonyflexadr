<?php
namespace App\DataFixtures;

use App\User\Domain\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User('WALKING CODER');
        $manager->persist($user);

        $user = new User('MARCEL');
        $manager->persist($user);

        $manager->flush();
    }

}