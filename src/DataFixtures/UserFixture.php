<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@admin.com');
        //$user->setPassword('papa');
        $user->setPassword('$2y$13$soeHaB5gd2nAhY.soYkIwumzdsv3c8r7aWOucLVhm9GHYYCw1gxCa');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
    public static function getGroups(): array
    {
        return ['userGroup'];
    }
}
