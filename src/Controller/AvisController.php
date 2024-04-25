<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Avis;
use App\Form\AvisType;
use Doctrine\ORM\EntityManagerInterface;

class AvisController extends AbstractController
{
    public function soumettreAvis(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avis);
            $entityManager->flush();
            $this->addFlash('success', 'Votre formulaire a été envoyé avec succès.');
            return $this->redirectToRoute('home');
        }

        // Récupérer tous les avis pour les afficher
        $tousLesAvis = $entityManager->getRepository(Avis::class)->findAll();

        return $this->render('home.html.twig', [
            'form' => $form->createView(),
            'avis' => $tousLesAvis,
        ]);
    }
}