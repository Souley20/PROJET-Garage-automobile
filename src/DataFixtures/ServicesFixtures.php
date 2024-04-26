<?php

namespace App\DataFixtures;

use App\Entity\Services;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'un tableau des services avec leur nom et description
        $servicesData = [
            [
                'Mecanique',
                '. Forfaits vidange et révision

            . Changement des filtres
            
            . Changement du liquide de refroidissement
            
            . Changement du liquide de  frein
            
            . Vidange boîte de vitesse ou pont'
            ],

            [
                'Révision & Vidange',
                '. Forfaits vidange et révision

            . Changement des filtres
            
            . Changement du liquide de refroidissement
            
            . Changement du liquide de  frein
            
            . Vidange boîte de vitesse ou pont'
            ],

            [
                'Freinage',
                '. Forfaits vidange et révision

            . Changement des filtres
            
            . Changement du liquide de refroidissement
            
            . Changement du liquide de  frein
            
            . Vidange boîte de vitesse ou pont'
            ],

            [
                'Distribution',
                '. Forfaits vidange et révision

            . Changement des filtres
            
            . Changement du liquide de refroidissement
            
            . Changement du liquide de  frein
            
            . Vidange boîte de vitesse ou pont'
            ],

            [
                'Amortisseurs',
                '. Forfaits vidange et révision

            . Changement des filtres
            
            . Changement du liquide de refroidissement
            
            . Changement du liquide de  frein
            
            . Vidange boîte de vitesse ou pont'
            ],

            [
                'Batterie & Éclairage',
                '. Forfaits vidange et révision

            . Changement des filtres
            
            . Changement du liquide de refroidissement
            
            . Changement du liquide de  frein
            
            . Vidange boîte de vitesse ou pont'
            ],
        ];

        foreach ($servicesData as [$nom, $description]) {
            $service = new Services();
            $service->setNom($nom);
            $service->setDescription($description);

            $manager->persist($service);
        }

        $manager->flush();
    }
}
