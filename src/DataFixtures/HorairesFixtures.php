<?php

namespace App\DataFixtures;

use App\Entity\Horaires;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HorairesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $horairesMatin = \DateTime::createFromFormat('H:i', '08:45');
        $horairesMidi = \DateTime::createFromFormat('H:i', '12:00');
        $horairesSoirOuverture = \DateTime::createFromFormat('H:i', '14:00');
        $horairesSoirFermeture = \DateTime::createFromFormat('H:i', '18:00');

        foreach ($jours as $jour) {
            $horaire = new Horaires();
            $horaire->setJours($jour);

            if ($jour !== 'Dimanche') { // Supposons que Dimanche est fermé
                $horaire->setHorairesOuverturesMatin($horairesMatin);
                $horaire->setHorairesFermeturesMatin($horairesMidi);
                $horaire->setHorairesOuverturesSoir($horairesSoirOuverture);
                $horaire->setHorairesFermeturesSoir($horairesSoirFermeture);
            } else {
                $horaire->setHorairesOuverturesMatin(null);
                $horaire->setHorairesFermeturesMatin(null);
                $horaire->setHorairesOuverturesSoir(null);
                $horaire->setHorairesFermeturesSoir(null);
            }

            $manager->persist($horaire);
        }

        $manager->flush();
    }
}
