<?php

namespace App\Controller;

use App\Repository\HorairesRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\VoituresOccasionsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class NosOccasionsController extends AbstractController
{
    #[Route('/nosOccasions', name: 'nosOccasions')]
    public function index(VoituresOccasionsRepository $voituresOccasionsRepository, HorairesRepository $horairesRepository, Request $request): Response
    {
        $horaires = $horairesRepository->findAll();

        if ($request->get('ajax')) {
            $voitures = $voituresOccasionsRepository->findAll();

            $voituresArray = array_map(function ($voiture) {
                $marque = $voiture->getVoituresOcassionsMarques();
                $image = null;
                if ($voiture->getVoituresOcassionsImages()->count() > 0) {
                    $image = $voiture->getVoituresOcassionsImages()->first()->getNom();
                }
                return [
                    'id' => $voiture->getId(),
                    'image' => $image,
                    'prix' => $voiture->getPrix(),
                    'annee' => $voiture->getAnnee()->format('Y'),
                    'kilometrage' => $voiture->getKilometrage(),
                    'carburant' => $voiture->getCarburant(),
                    'boiteDeVitesse' => $voiture->getBoiteDeVitesse(),
                    'marque' => $marque ? [
                        'id' => $marque->getId(),
                        'nom' => $marque->getNomMarques(),
                        'modeles' => $marque->getModeles(),
                    ] : null,
                ];
            }, $voitures);

            return new JsonResponse($voituresArray);
        }

        return $this->render('nosOccasions.html.twig', [
            'voituresOccasions' => $voituresOccasionsRepository->findAll(),
            'horaires' => $horaires
        ]);
    }
}