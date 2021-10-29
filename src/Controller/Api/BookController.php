<?php

namespace App\Controller\Api;

use App\Entity\Book;
use App\Form\Api\BookSearchType;
use App\Form\Api\BookType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends ApiController
{
    #[Route('/api/books', name: 'app_api_book_collection', methods: ['GET'])]
    public function collection(): Response
    {
        return $this->getCollection(BookSearchType::class, Book::class);
    }

    #[Route('/api/books/{id}', name: 'app_api_book_document', methods: ['GET'])]
    public function document(Book $book): Response
    {
        return $this->getDocument($book);
    }

    #[Route('/api/books', name: 'app_api_book_create', methods: ['POST'])]
    public function create(): Response
    {
        return $this->createDocument(BookType::class);
    }

    #[Route('/api/books/{id}', name: 'app_api_book_update', methods: ['PATCH'])]
    public function update(Book $book): Response
    {
        return $this->updateDocument($book, BookType::class);
    }

    #[Route('/api/books/{id}', name: 'app_api_book_delete', methods: ['DELETE'])]
    public function delete(Book $book): Response
    {
        return $this->deleteDocument($book);
    }
}
