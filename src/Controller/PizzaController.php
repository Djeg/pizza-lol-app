<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    /**
     * @Route("/search", name="app_pizza_search")
     */
    public function search(): Response
    {
        return $this->render('pizza/search.html.twig');
    }

    /**
     * @Route("/nouvelle-pizza", name="app_pizza_create")
     */
    public function create(): Response
    {
        return $this->render('pizza/create.html.twig');
    }

    /**
     * @Route("/pizza/{id}", name="app_pizza_display")
     */
    public function display(int $id): Response
    {
        return $this->render('pizza/display.html.twig');
    }
}
