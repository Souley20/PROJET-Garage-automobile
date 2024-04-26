<?php

namespace App\DataFixtures;

use App\Entity\FormulaireDeRenseignement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormulaireDeRenseignementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $formulaire = new FormulaireDeRenseignement();
        $formulaire->setNom('Fabert');
        $formulaire->setPrenom('Jonathan');
        $formulaire->setTelephone('0678664554');
        $formulaire->setEmail('fabert.jonathan@gmail.com');
        $formulaire->setSujet('Demande de renseignements pour réparation de carburateur sur véhicule ancien');
        $formulaire->setMessage(
            'Madame, Monsieur,
        Je me permets de vous contacter pour solliciter votre expertise concernant la réparation d\'un carburateur sur ma voiture ancienne [Précisez le modèle et l\'année de la voiture]. Ce véhicule, qui a une grande valeur sentimentale pour moi, rencontre actuellement des problèmes liés au carburateur, notamment [décrivez les symptômes ou problèmes rencontrés].
        Pouvez-vous me fournir des informations sur les services que vous proposez pour ce type de réparation ? Je suis particulièrement intéressé(e) par les éléments suivants :
        Diagnostic et estimation : Disposez-vous des équipements nécessaires pour effectuer un diagnostic précis des problèmes de carburateur sur des véhicules anciens ?
        Réparation et pièces de rechange : Avez-vous accès à des pièces de rechange spécifiques pour ce modèle de véhicule ou effectuez-vous des réparations personnalisées ?
        Coût et durée : Quelle serait une estimation du coût et du temps nécessaire pour une telle réparation ?
        Expérience et références : Pouvez-vous fournir des exemples ou des références de travaux similaires que vous avez réalisés sur des véhicules de ce type ?
        Je reste à votre disposition pour vous fournir tout renseignement complémentaire nécessaire ou pour planifier un rendez-vous afin d\'examiner le véhicule plus en détail.
        Je vous remercie par avance pour votre réponse et espère que vous pourrez m\'aider à remettre ce précieux véhicule en état de fonctionnement optimal.
        Cordialement'
        );
        $formulaire->setValide(true);

        $manager->persist($formulaire);
        $manager->flush();
    }
}
