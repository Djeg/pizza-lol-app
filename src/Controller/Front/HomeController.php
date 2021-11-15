<?php

namespace App\Controller\Front;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_front_home_index')]
    public function index(BookRepository $books, CategoryRepository $categories, AuthorRepository $authors): Response
    {
        $lastBooks = $books->findLast();
        $lastCategories = $categories->findLast();
        $lastAuthors = $authors->findLast();

        return $this->render('front/home/index.html.twig', [
            'books' => $lastBooks,
            'categories' => $lastCategories,
            'authors' => $lastAuthors,
        ]);
    }
}
