<?php

namespace App\DataFixtures;

use App\Entity\Images;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImagesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $fichiers = ['citroenDSGrise.png'];
        $nombreDeVoitures = 10;

        for ($i = 0; $i < $nombreDeVoitures; $i++) {
            foreach ($fichiers as $fichier) {
                $image = new Images();
                $file = new File(__DIR__ . '/../../public/css/assets/' . $fichier);
                $image->setFile($file);
                $image->setNom($fichier);
                $voitureReference = 'voiture-' . $i;
                if ($this->hasReference($voitureReference)) {
                    $voiture = $this->getReference($voitureReference);
                    $image->setVoituresOccasions($voiture);
                    $manager->persist($image);
                }
            }
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            VoituresOccasionsFixtures::class,
        ];
    }
}
