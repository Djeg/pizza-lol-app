<?php

namespace App\Controller\Front;

use App\Entity\Order;
use App\Form\Front\CreditCardType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    #[Route('/mes-commandes/payer', name: 'app_front_order_create')]
    #[IsGranted('ROLE_USER')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $basket = $this->getUser()->getBasket();

        $form = $this->createForm(CreditCardType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order = Order::makeFromBasket($basket);
            $basket->clear();

            $manager->persist($basket);
            $manager->persist($order);

            $manager->flush();

            return $this->redirectToRoute('app_front_order_show', [
                'id' => $order->getId(),
            ]);
        }

        return $this->render('front/order/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/mes-commandes/{id}', name: 'app_front_order_show')]
    #[IsGranted('ROLE_USER')]
    public function show(Order $order): Response
    {
        return $this->render('front/order/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/mes-commandes', name: 'app_front_order_index')]
    #[IsGranted('ROLE_USER')]
    public function index(OrderRepository $repo): Response
    {
        $orders = $repo->findAllByUser($this->getUser());

        return $this->render('front/order/index.html.twig', [
            'orders' => $orders,
        ]);
    }
}
