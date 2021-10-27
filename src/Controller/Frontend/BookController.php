<?php

namespace App\Controller\Frontend;

use App\Controller\BaseController;
use App\DTO\BookSearchCriteria;
use App\Entity\Book;
use App\Form\Frontend\BookSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends BaseController
{
    #[Route('/livres/{id}', name: 'app_frontend_book_display')]
    public function display(Book $book): Response
    {
        return $this->render('frontend/book/display.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/rechercher', name: 'app_frontend_book_search')]
    public function search(): Response
    {
        $form = $this->createAndHandleForm(BookSearchType::class, new BookSearchCriteria());

        $books = $this->getBookRepository()->findAllByCriteria($form->getData());

        return $this->render('frontend/book/search.html.twig', [
            'form' => $form->createView(),
            'books' => $books,
        ]);
    }
}
