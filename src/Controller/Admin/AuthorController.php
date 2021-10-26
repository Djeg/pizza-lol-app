<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\Admin\AuthorType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends CRUDController
{
    #[Route('/admin/auteurs', name: 'app_admin_author_index')]
    public function index(): Response
    {
        return $this->list('author', Author::class, 'authors');
    }

    #[Route('/admin/auteurs/nouveau', name: 'app_admin_author_create')]
    public function create(): Response
    {
        return $this->createOrUpdate('author', AuthorType::class, null, function (Author $author) {
            return "L'auteur {$author->getName()} à bien été créé";
        });
    }

    #[Route('/admin/auteurs/{id}', name: 'app_admin_author_update')]
    public function update(Author $author): Response
    {
        return $this->createOrUpdate('author', AuthorType::class, $author, function (Author $author) {
            return "L'auteur {$author->getName()} à bien été mis à jour";
        });
    }

    #[Route('/admin/auteurs/{id}/supprimer', name: 'app_admin_author_delete')]
    public function delete(Author $author): Response
    {
        return $this->remove('author', $author, function (Author $author) {
            return "L'auteur {$author->getName()} à bien été supprimé";
        });
    }
}
