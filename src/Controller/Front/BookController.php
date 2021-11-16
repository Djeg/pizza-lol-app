<?php

namespace App\Controller\Front;

use App\Entity\Book;
use App\Form\Front\NewBookType;
use App\Form\Front\BookSearchType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookController extends AbstractController
{
    #[Route('/rechercher', name: 'app_front_book_search')]
    public function search(Request $request, BookRepository $repository): Response
    {
        $form = $this->createForm(BookSearchType::class);

        $form->handleRequest($request);

        $books = $repository->findByCriteria($form->getData());

        return $this->render('front/book/search.html.twig', [
            'form' => $form->createView(),
            'books' => $books,
        ]);
    }

    #[Route('/livre/{id}-{slug}', name: 'app_front_book_show')]
    public function show(int $id, string $slug, BookRepository $repository): Response
    {
        $book = $repository->findOneBy([
            'id' => $id,
            'slug' => $slug,
        ]);

        return $this->render('front/book/show.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/revendre-un-livre', name: 'app_front_book_sell')]
    #[IsGranted('ROLE_USER')]
    public function sell(Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(NewBookType::class, null, [
            'user' => $this->getUser(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('app_front_book_show', [
                'id' => $form->getData()->getId(),
                'slug' => $form->getData()->getSlug(),
            ]);
        }

        return $this->render('front/book/sell.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modifier-livre/{id}-{slug}', name: 'app_front_book_modify')]
    #[IsGranted('ROLE_USER')]
    public function modify(
        int $id,
        string $slug,
        Request $request,
        EntityManagerInterface $manager,
        BookRepository $repo
    ): Response {
        $book = $repo->findOneBy([
            'id' => $id,
            'slug' => $slug,
        ]);

        if ($book->getDealer()->getId() !== $this->getUser()->getId()) {
            throw new NotFoundHttpException('Le livre n\'a pas était trouvé');
        }

        $form = $this->createForm(NewBookType::class, $book, [
            'user' => $this->getUser(),
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('app_front_book_show', [
                'id' => $form->getData()->getId(),
                'slug' => $form->getData()->getSlug(),
            ]);
        }

        return $this->render('front/book/modify.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/supprimer-livre/{id}', name: 'app_front_book_delete')]
    #[IsGranted('ROLE_USER')]
    public function delete(
        Book $book,
        EntityManagerInterface $manager,
        Request $request,
    ): Response {
        $manager->remove($book);
        $manager->flush();

        if ($request->query->get('from')) {
            return $this->redirect($request->query->get('from'));
        }

        if ($request->headers->get('Referer')) {
            return $this->redirect($request->headers->get('Referer'));
        }

        return $this->redirectToRoute('app_front_user_profile');
    }
}
