<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'un utilisateur
        $user1 = new User();
        $user1->setEmail('admin@example.com')
            ->setPassword('adminpassword') // Utilisez un mot de passe sécurisé dans un vrai projet
            ->setName('Admin User')
            ->setRoles(['ROLE_ADMIN']); // Utilisateur avec un rôle d'administrateur

        $manager->persist($user1);

        // Création d'un deuxième utilisateur
        $user2 = new User();
        $user2->setEmail('user2@example.com')
            ->setPassword('userpassword')
            ->setName('Regular User')
            ->setRoles(['ROLE_USER']); // Utilisateur avec un rôle utilisateur classique

        $manager->persist($user2);

        // Sauvegarde des utilisateurs
        $manager->flush();
    }
}
