<?php

namespace App\Controller;

use App\DTO\ArticleSearchCriteria;
use App\Form\ArticleSearchType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, ArticleRepository $repository): Response
    {
        // Création du formulaire de recherche d'article
        $form = $this->createForm(ArticleSearchType::class);

        // On remplie le formulaire avec les données que l'utilisateur
        // à remplie dans notre page HTML
        $form->handleRequest($request);

        // Nous récupérons le DTO de notre formulaire
        $criteria = $form->getData();

        dump($criteria);

        // Permet de récupérer tout les articles de la base de données
        $articles = $repository->findAllByCriteria($criteria);

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'form' => $form->createView(), // Créer le HTML du formulaire !
        ]);
    }
}
