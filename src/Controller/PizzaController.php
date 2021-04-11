<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PizzaController extends AbstractController
{
    /**
     * @Route("/pizza/create", name="app_pizza_create", methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(PizzaType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pizza = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($pizza);
            $manager->flush();

            return $this->redirectToRoute('app_pizza_list');
        }

        return $this->render('pizza/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/pizza/list", name="app_pizza_list")
     */
    public function list(): Response
    {
        $pizzas = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Pizza::class)
            ->findAll();

        return $this->render('pizza/list.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }


    /**
     * @Route("/pizza/generate", name="app_pizza_generate")
     */
    public function generate(Request $request): Response
    {
        $name = $request->query->get('name') ?? $request->request->get('name', 'Régina');
        $price = $request->query->get('price') ?? $request->request->get('price', 9.9);

        $pizza = new Pizza();
        $pizza->setName($name);
        $pizza->setPrice(floatval($price));

        $manager = $this->getDoctrine()->getManager();

        $manager->persist($pizza);
        $manager->flush();

        return new Response(sprintf('OK %s', $pizza->getId()));
    }
}
