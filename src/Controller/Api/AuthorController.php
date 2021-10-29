<?php

namespace App\Controller\Api;

use App\Controller\BaseController;
use App\Entity\Author;
use App\Form\Api\AuthorType;
use App\Form\Api\SearchAuthorType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends ApiController
{
    #[Route('/api/authors', name: 'app_api_author_collection', methods: ['GET'])]
    public function collection(): Response
    {
        return $this->getCollection(SearchAuthorType::class, Author::class);
    }

    #[Route('/api/authors/{id}', name: 'app_api_author_document', methods: ['GET'])]
    public function document(Author $author): Response
    {
        return $this->getDocument($author);
    }

    #[Route('/api/authors', name: 'app_api_author_create', methods: ['POST'])]
    public function create(): Response
    {
        return $this->createDocument(AuthorType::class);
    }

    #[Route('/api/authors/{id}', name: 'app_api_author_update', methods: ['PATCH'])]
    public function update(Author $author): Response
    {
        return $this->updateDocument($author, AuthorType::class);
    }

    #[Route('/api/authors/{id}', name: 'app_api_author_delete', methods: ['DELETE'])]
    public function delete(Author $author): Response
    {
        return $this->deleteDocument($author);
    }
}
