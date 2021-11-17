<?php

namespace App\Controller\Front;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasketController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_front_basket_index')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('front/basket/index.html.twig');
    }

    #[Route('/mon-panier/ajouter/{id}', name: 'app_front_basket_add')]
    #[IsGranted('ROLE_USER')]
    public function add(Request $request, Book $book, EntityManagerInterface $manager): Response
    {
        $basket = $this->getUser()->getBasket();

        if (!$basket->getBooks()->contains($book)) {
            $basket->addBook($book);

            $manager->persist($basket);
            $manager->flush();
        }

        if ($request->query->has('from')) {
            return $this->redirect($request->query->get('from'));
        }

        if ($request->headers->has('Referer')) {
            return $this->redirect($request->headers->get('Referer'));
        }

        return $this->redirectToRoute('app_front_basket_index');
    }

    #[Route('/mon-panier/supprimer/{id}', name: 'app_front_basket_remove')]
    #[IsGranted('ROLE_USER')]
    public function remove(Request $request, Book $book, EntityManagerInterface $manager): Response
    {
        $basket = $this->getUser()->getBasket();

        if ($basket->getBooks()->contains($book)) {
            $basket->removeBook($book);

            $manager->persist($basket);
            $manager->flush();
        }

        if ($request->query->has('from')) {
            return $this->redirect($request->query->get('from'));
        }

        if ($request->headers->has('Referer')) {
            return $this->redirect($request->headers->get('Referer'));
        }

        return $this->redirectToRoute('app_front_basket_index');
    }
}
