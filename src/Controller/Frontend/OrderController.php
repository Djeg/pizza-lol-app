<?php

namespace App\Controller\Frontend;

use App\Controller\BaseController;
use App\Entity\Order;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends BaseController
{
    #[Route('/vos-commandes', name: 'app_frontend_order_index')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        $orders = $this->getOrderRepository()->findAllForUser($this->getUser());

        return $this->render('frontend/order/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    #[Route('/commandes/{id}/confirmation', name: 'app_frontend_order_confirm')]
    #[IsGranted('ROLE_USER')]
    public function confirm(Order $order): Response
    {
        return $this->render('frontend/order/confirm.html.twig', [
            'order' => $order,
        ]);
    }
}
