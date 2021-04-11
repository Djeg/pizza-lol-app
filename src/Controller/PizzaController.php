<?php

namespace App\Controller;

use App\Entity\Pizza;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PizzaController extends AbstractController
{
    /**
     * @Route("/pizza/generate", name="app_pizza_generate")
     */
    public function generate(Request $request): Response
    {
        $name = $request->query->get('name') || $request->request->get('name', 'Régina');
        $price = $request->query->get('price') || $request->request->get('price', 9.9);

        $pizza = new Pizza();
        $pizza->setName($name);
        $pizza->setPrice(floatval($price));

        $manager = $this->getDoctrine()->getManager();

        $manager->persist($pizza);
        $manager->flush();

        return new Response(sprintf('OK %s', $pizza->getId()));
    }
}
