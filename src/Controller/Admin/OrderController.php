<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends CRUDController
{
    #[Route('/admin/commandes', name: 'app_admin_order_index')]
    public function index(): Response
    {
        return $this->list('order', Order::class, 'orders');
    }
}
