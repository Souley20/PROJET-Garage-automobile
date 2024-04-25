<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\HorairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\FormulaireDeRenseignement;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, HorairesRepository $horairesRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formulaireDeRenseignement = new FormulaireDeRenseignement();
            $formulaireDeRenseignement->setNom($form->get('nom')->getData());
            $formulaireDeRenseignement->setPrenom($form->get('prenom')->getData());
            $formulaireDeRenseignement->setTelephone($form->get('telephone')->getData());
            $formulaireDeRenseignement->setEmail($form->get('email')->getData());
            $formulaireDeRenseignement->setSujet($form->get('sujet')->getData());
            $formulaireDeRenseignement->setMessage($form->get('message')->getData());
            $formulaireDeRenseignement->setValide(false);

            $entityManager->persist($formulaireDeRenseignement);
            $entityManager->flush();

            $this->addFlash('success', 'Votre formulaire a été envoyé avec succès.');
            return $this->redirectToRoute('home');
        }

        return $this->render('contact.html.twig', [
            'contactForm' => $form->createView(),
            'horaires' => $horairesRepository->findBy([])
        ]);
    }
}