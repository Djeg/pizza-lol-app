<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ce controller contient toutes les pages
 * visible pour un utilisateur du e-commerce.
 */
class FrontendController extends AbstractController
{
    /**
     * @Route("/", name="app_frontend_home")
     */
    public function home(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Book::class);

        $books = $repository->findAll();

        return $this->render('frontend/home.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/rechercher", name="app_frontend_search")
     */
    public function search(Request $request): Response
    {
        $name = $request->query->get('name');

        $repository = $this->getDoctrine()->getRepository(Book::class);

        if (empty($name)) {
            $books = $repository->findAll();
        } else {
            $books = $repository->findBy([
                'name' => $name,
            ]);
        }

        return $this->render('frontend/search.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/nouveau-livre", name="app_frontend_newBook")
     */
    public function newBook(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $book = (new Book())
                ->setName($request->request->get('name'))
                ->setDescription($request->request->get('description'))
                ->setImage($request->request->get('image'))
                ->setPrice((float)$request->request->get('price'));

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($book);

            $manager->flush();

            return $this->redirectToRoute('app_frontend_displayBook', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('frontend/newBook.html.twig');
    }

    /**
     * @Route("/livres/{id}", name="app_frontend_displayBook")
     */
    public function displayBook(int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Book::class);

        $book = $repository->find($id);

        return $this->render('frontend/displayBook.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/livres/{id}/modifier", name="app_frontend_modifyBook")
     */
    public function modifyBook(Book $book, Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $book
                ->setName($request->request->get('name'))
                ->setDescription($request->request->get('description'))
                ->setImage($request->request->get('image'))
                ->setPrice((float)$request->request->get('price'));

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($book);

            $manager->flush();

            return $this->redirectToRoute('app_frontend_displayBook', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('frontend/modifyBook.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/livres/{id}/supprimer", name="app_frontend_deleteBook")
     */
    public function deleteBook(Book $book): Response
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($book);

        $manager->flush();

        return $this->render('frontend/deleteBook.html.twig', [
            'book' => $book,
        ]);
    }
}
