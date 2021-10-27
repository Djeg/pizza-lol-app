<?php

namespace App\Controller\Frontend;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/livres/{id}', name: 'app_frontend_book_display')]
    public function display(Book $book): Response
    {
        return $this->render('frontend/book/display.html.twig', [
            'book' => $book,
        ]);
    }
}
