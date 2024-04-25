<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use App\Repository\HorairesRepository;
use App\Repository\ServicesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home', methods: ['GET'], schemes:[HTTP])]
    public function home(Request $request, EntityManagerInterface $entityManager, ServicesRepository $servicesRepository, AvisRepository $avisRepository, HorairesRepository $horairesRepository): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avis);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('home.html.twig', [
            'services' => $servicesRepository->findBy([]),
            'avis' => $avisRepository->findBy([]),
            'horaires' => $horairesRepository->findBy([]),
            'form' => $form->createView()
        ]);
    }
}