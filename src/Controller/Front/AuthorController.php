<?php

namespace App\Controller\Front;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/auteur/{id}-{slug}', name: 'app_front_author_show')]
    public function index(int $id, string $slug, AuthorRepository $repo): Response
    {
        $author = $repo->findOneBy([
            'id' => $id,
            'slug' => $slug,
        ]);

        return $this->render('front/author/show.html.twig', [
            'author' => $author,
        ]);
    }
}
