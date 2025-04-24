<?php

namespace App\DataFixtures;

use App\Entity\Sanctuary;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SanctuaryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'un utilisateur pour les sanctuaires
        $user = new User();
        $user->setEmail('user1@example.com')
            ->setPassword('password') // Utilisez un mot de passe sécurisé dans un vrai projet
            ->setName('John Doe')
            ->setRoles(['ROLE_USER']); // Utilisateur avec un rôle simple

        $manager->persist($user);

        // Création de 3 sanctuaires associés à cet utilisateur
        $sanctuary1 = new Sanctuary();
        $sanctuary1->setName('Sanctuary 1')
            ->setDescription('A beautiful sanctuary located in the mountains.')
            ->setDateFondation(new \DateTime('2000-01-01'))
            ->setEntryPrice(20)
            ->setLatitude('48.8566')
            ->setLongitude('2.3522')
            ->setEmailContact('contact1@sanctuary.com')
            ->setPhoto('sanctuary1.jpg')
            ->setCreator($user); // Lier l'utilisateur comme créateur

        $manager->persist($sanctuary1);

        $sanctuary2 = new Sanctuary();
        $sanctuary2->setName('Sanctuary 2')
            ->setDescription('A peaceful sanctuary by the sea.')
            ->setDateFondation(new \DateTime('2010-05-15'))
            ->setEntryPrice(15)
            ->setLatitude('34.0522')
            ->setLongitude('-118.2437')
            ->setEmailContact('contact2@sanctuary.com')
            ->setPhoto('sanctuary2.jpg')
            ->setCreator($user);

        $manager->persist($sanctuary2);

        $sanctuary3 = new Sanctuary();
        $sanctuary3->setName('Sanctuary 3')
            ->setDescription('A sanctuary with historical significance.')
            ->setDateFondation(new \DateTime('1800-07-22'))
            ->setEntryPrice(25)
            ->setLatitude('51.5074')
            ->setLongitude('0.1278')
            ->setEmailContact('contact3@sanctuary.com')
            ->setPhoto('sanctuary3.jpg')
            ->setCreator($user);

        $manager->persist($sanctuary3);

        // Sauvegarde de tous les objets persistés
        $manager->flush();
    }
}
