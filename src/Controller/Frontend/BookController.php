<?php

namespace App\Controller\Frontend;

use App\Controller\BaseController;
use App\DTO\BookSearchCriteria;
use App\Entity\Book;
use App\Form\Frontend\BookSearchType;
use App\Form\Frontend\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends BaseController
{
    #[Route('/livres/{id}', name: 'app_frontend_book_display')]
    public function display(Book $book): Response
    {
        $commentForm = $this->createForm(CommentType::class, null, [
            'action' => $this->generateUrl('app_frontend_comment_add', [
                'id' => $book->getId(),
            ])
        ]);

        $comments = $this->getCommentRepository()->findAllForBook($book);

        return $this->render('frontend/book/display.html.twig', [
            'book' => $book,
            'comments' => $comments,
            'commentForm' => $commentForm->createView(),
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
