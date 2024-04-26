<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setNom('Parrot');
        $admin->setPrenom('Vincent');
        $admin->setEmail('parrot.vincent@gmail.com');
        $admin->setRoles(['ROLE_ADMINISTRATEUR']);
        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'admin')
        );

        $manager->persist($admin);

        $employe = new User();
        $employe->setNom('Alderson');
        $employe->setPrenom('Eliot');
        $employe->setEmail('alderson.eliot@gmail.com');
        $employe->setRoles(['ROLE_EMPLOYE']);
        $employe->setPassword(
            $this->passwordHasher->hashPassword($employe, 'employe')
        );

        $manager->persist($employe);
        $manager->flush();
    }
}
