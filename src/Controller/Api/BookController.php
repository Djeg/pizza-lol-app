<?php

namespace App\Controller\Api;

use App\Entity\Book;
use App\Form\Front\BookSearchType;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'api_book_list', methods: ['GET'])]
    public function index(Request $request, BookRepository $repository): Response
    {
        $form = $this->createForm(BookSearchType::class);

        $form->handleRequest($request);

        $books = $repository->findByCriteria($form->getData());

        $response = $this->json($books);

        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    #[Route('/api/books/{id}', name: 'api_book_show', methods: ['GET'])]
    public function show(Book $book): Response
    {
        $response = $this->json($book);

        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
