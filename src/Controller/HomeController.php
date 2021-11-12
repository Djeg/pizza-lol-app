<?php

namespace App\Controller;

use App\Form\ArticleSearchType;
use App\DTO\ArticleSearchCriteria;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @IsGranted("ROLE_COUCOU_LES_AMIS")
     */
    public function index(Request $request, ArticleRepository $repository): Response
    {
        // Retourne l'utilisateur connécté
        $user = $this->getUser(); // null|User
        // Création du formulaire de recherche d'article
        $form = $this->createForm(ArticleSearchType::class);

        // On remplie le formulaire avec les données que l'utilisateur
        // à remplie dans notre page HTML
        $form->handleRequest($request);

        // Nous récupérons le DTO de notre formulaire
        $criteria = $form->getData(); // $criteria => ArticleSearchCriteria

        // Permet de récupérer tout les articles de la base de données
        $articles = $repository->findAllByCriteria($criteria);

        // $articles => array<Article>

        //foreach ($articles as $article) {
        //    // $article => Article
        //    // $title => string
        //    $title = $article->getTitle();

        //    // $author => Author
        //    $author = $article->getAuthor();

        //    // $articles => Collection<Article>
        //    $authorArticles = $author->getArticles();

        //    $article->getAuthor()->getFirstname(); // string

        //    // Objet « Fluent »
        //    $article->setDescription('coucou')->setTitle('test'); // Article
        //}

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/mon-profile", name="profile")
     * @IsGranted("ROLE_USER")
     */
    public function profil(): Response
    {
        $user = $this->getUser();

        return $this->render('home/profil.html.twig', [
            'user' => $user,
        ]);
    }
}
