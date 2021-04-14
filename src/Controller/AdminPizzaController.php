<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\AdminPizzaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPizzaController extends AbstractController
{
    /**
     * @Route("/admin/pizza/list", name="app_admin_pizza_list")
     */
    public function list(): Response
    {
        $pizzas = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Pizza::class)
            ->findAll();

        return $this->render('admin_pizza/list.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }

    /**
     * @Route("/admin/pizza/create", name="app_admin_pizza_create")
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(AdminPizzaType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pizza = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($pizza);
            $manager->flush();

            return $this->redirectToRoute('app_admin_pizza_list');
        }

        $formView = $form->createView();

        return $this->render('admin_pizza/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    /**
     * @Route("/admin/pizza/{id}/update", name="app_admin_pizza_update")
     */
    public function update(Pizza $pizza, Request $request): Response
    {
        $form = $this->createForm(AdminPizzaType::class, $pizza);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pizza = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($pizza);
            $manager->flush();

            return $this->redirectToRoute('app_admin_pizza_list');
        }

        $formView = $form->createView();

        return $this->render('admin_pizza/update.html.twig', [
            'formView' => $formView,
            'pizza' => $pizza,
        ]);
    }

    /**
     * @Route("/admin/pizza/{id}/delete", name="app_admin_pizza_delete")
     */
    public function delete(Pizza $pizza): Response
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($pizza);
        $manager->flush();

        return $this->redirectToRoute('app_admin_pizza_list');
    }
}
