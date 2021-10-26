<?php

namespace App\Controller\Frontend;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends BaseController
{
    #[Route('/', name: 'app_frontend_home_index')]
    public function index(): Response
    {
        // retrieve the last 10 books
        $books = $this->getBookRepository()->findLast(10);
        // retrieve the last 10 authors
        $authors = $this->getAuthorRepository()->findLast(10);
        // retrieve all book kinds
        $kinds = $this->getKindRepository()->findAll();

        return $this->render('frontend/home/index.html.twig', [
            'books' => $books,
            'authors' => $authors,
            'kinds' => $kinds,
        ]);
    }
}
