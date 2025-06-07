<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\SpecialiteRepository;
use App\Repository\ProfessionnelRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfessionnelsController extends AbstractController
{
    #[Route('/professionnels', name: 'app_professionnels')]
    public function index(
        Request $request,
        ProfessionnelRepository $professionnelRepository,
        CategorieRepository $categorieRepository,
        SpecialiteRepository $specialiteRepository,
        PaginatorInterface $paginator,
    ): Response
    {
        // Récupération des filtres dans l'URL
        $categorieId = $request->query->get('categorie');
        $specialiteId = $request->query->get('specialite');

        // Récupération des catégories pour le select
        $categories = $categorieRepository->findAll();

        // Récupération des spécialités liées à la catégorie sélectionnée
        $specialites = [];
        if ($categorieId) {
            $specialites = $specialiteRepository->findByCategorie($categorieId);
        }

        // Récupération des professionnels filtrés
        $filters = [];

        if ($categorieId) {
            $filters['categorie'] = $categorieId;
        }
        if ($specialiteId) {
            $filters['specialite'] = $specialiteId;
        }

        $queryBuilder = $professionnelRepository->findByFilters($filters);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            5
        );

        // Render result si requête ajax
        if ($request->isXmlHttpRequest()) {
            return $this->render('professionnels/_result.html.twig', [
                'professionnels' => $pagination
            ]);
        }

        // Render page complète
        return $this->render('professionnels/index.html.twig', [
            'professionnels' => $pagination,
            'categories' => $categories,
            'specialites' => $specialites,
            'selected_categorie' => $categorieId,
            'selected_specialite' => $specialiteId,
        ]);
    }
}
