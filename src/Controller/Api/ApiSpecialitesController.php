<?php

namespace App\Controller\Api;

use App\Repository\SpecialiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiSpecialitesController extends AbstractController
{
    #[Route('/api/specialites', name: 'app_api_specialites')]
    public function index(Request $request, SpecialiteRepository $specialiteRepository): JsonResponse
    {
        $categorieId = $request->query->get('categorie');

        if (!$categorieId) {
            return new JsonResponse(['error' => 'Paramètre categorie absent'], 400);
        }

        $specialites = $specialiteRepository->findByCategorie($categorieId);

        $data = array_map(function($specialite) {
            return [
                'id' => $specialite->getId(),
                'libelle' => $specialite->getLibelle(),
            ];
        }, $specialites);

        return new JsonResponse($data);
    }
}
