<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Form\Admin\BookType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends CRUDController
{
    #[Route('/admin/livres', name: 'app_admin_book_index')]
    public function index(): Response
    {
        return $this->list('book', Book::class, 'books');
    }

    #[Route('/admin/livres/nouveau', name: 'app_admin_book_create')]
    public function create(): Response
    {
        return $this->createOrUpdate('book', BookType::class, null, function (Book $book) {
            return "Le livre “{$book->getTitle()}” à bien été créé";
        });
    }

    #[Route('/admin/livres/{id}', name: 'app_admin_book_update')]
    public function update(Book $book): Response
    {
        return $this->createOrUpdate('book', BookType::class, $book, function (Book $book) {
            return "Le livre “{$book->getTitle()}” à bien été mis à jour";
        });
    }

    #[Route('/admin/livres/{id}/supprimer', name: 'app_admin_book_delete')]
    public function delete(Book $book): Response
    {
        return $this->remove('book', $book, function (Book $book) {
            return "Le livre “{$book->getTitle()}” à bien été supprimé";
        });
    }
}
