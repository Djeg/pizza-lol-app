<?php

namespace App\Controller\Frontend;

use App\Entity\Book;
use App\Controller\BaseController;
use App\Entity\Order;
use App\Form\Frontend\CreditCardType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class BasketController extends BaseController
{
    #[Route('/panier', name: 'app_frontend_basket_index')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('frontend/basket/index.html.twig');
    }

    #[Route('/panier/{id}/ajouter', name: 'app_frontend_basket_add')]
    #[IsGranted('ROLE_USER')]
    public function add(Book $book, Request $request): Response
    {
        $basket = $this->getUser()->getBasket();

        $basket->addBook($book);

        $this->persistAndFlush($basket);

        return new RedirectResponse($request->headers->get('referer', $this->generateUrl('app_frontend_home_index')));
    }

    #[Route('/panier/{id}/supprimer', name: 'app_frontend_basket_remove')]
    #[IsGranted('ROLE_USER')]
    public function remove(Book $book, Request $request): Response
    {
        $basket = $this->getUser()->getBasket();

        $basket->removeBook($book);

        $this->persistAndFlush($basket);

        return new RedirectResponse($request->headers->get('referer', $this->generateUrl('app_frontend_home_index')));
    }

    #[Route('/panier/recapitulatif', name: 'app_frontend_basket_recap')]
    #[IsGranted('ROLE_USER')]
    public function recap(): Response
    {
        return $this->render('frontend/basket/recap.html.twig');
    }

    #[Route('/panier/paiement', name: 'app_frontend_basket_pay')]
    #[IsGranted('ROLE_USER')]
    public function pay(): Response
    {
        $form = $this->createAndHandleForm(CreditCardType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $basket = $this->getUser()->getBasket();
            $order = Order::createFrom($form->getData(), $basket);

            $this->persist($order);
            $this->persist($basket->empty());

            $this->flush();

            return $this->redirectToRoute('app_frontend_order_confirm', [
                'id' => $order->getId(),
            ]);
        }

        return $this->render('frontend/basket/pay.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
