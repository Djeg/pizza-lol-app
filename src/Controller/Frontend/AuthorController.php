<?php

namespace App\Controller\Frontend;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/auteurs/{id}', name: 'app_frontend_author_display')]
    public function display(Author $author): Response
    {
        return $this->render('frontend/author/display.html.twig', [
            'author' => $author,
        ]);
    }
}
