<?php

namespace App\DataFixtures;

use App\Entity\Avis;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AvisFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $avi1 = new Avis();
        $avi1->setNom('F');
        $avi1->setPrenom('Jonathan');
        $avi1->setCommentaire('Tres bonne experience, je pense que tout dépend du personnel. Il y a dans ce magasin un monsieur qui maîtrise son job à la perfection. Malheureusement j\'ai appris
        qu\'il songeait à prendre sa retraite...');
        $avi1->setDate(\DateTime::createFromFormat('d-m-Y H:i', '25-12-2023 20:30'));
        $avi1->setValide(true);
        $manager->persist($avi1);

        $avi2 = new Avis();
        $avi2->setNom('S');
        $avi2->setPrenom('Natacha');
        $avi2->setCommentaire('Travail bien fait mais 3h pour une révision à la place de 1h30, beaucoup d’attente plutôt que de m’annoncer directement le temps…');
        $avi2->setDate(\DateTime::createFromFormat('d-m-Y H:i', '13-11-2001 19:44'));
        $avi2->setValide(true);
        $manager->persist($avi2);

        $avi3 = new Avis();
        $avi3->setNom('G');
        $avi3->setPrenom('Patrick');
        $avi3->setCommentaire('Espace de vente propre, lumineux, bien agencé, personnel attentif à la demande. Tarifs prestations dans la moyenne, promotions régulières avec le site. Horaires des RDV respectés Manager actif, réactif, professionnel. Très bien je recommande !');
        $avi3->setDate(\DateTime::createFromFormat('d-m-Y H:i', '30-11-2001 09:08'));
        $avi3->setValide(true);
        $manager->persist($avi3);

        $manager->flush();
    }
}
