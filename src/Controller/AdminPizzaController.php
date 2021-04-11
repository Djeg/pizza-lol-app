<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\AdminPizzaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AdminPizzaController extends AbstractController
{
    /**
     * @Route("/admin/pizza/create", name="app_admin_pizza_create", methods={"GET", "POST"})
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

        return $this->render('admin_pizza/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/pizza/{id}/update", name="app_admin_pizza_update", methods={"GET", "POST"})
     */
    public function update(Pizza $pizza, Request $request): Response
    {
        $form = $this->createForm(AdminPizzaType::class, $pizza);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $validPizza = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($validPizza);

            $manager->flush();

            return $this->redirectToRoute('app_admin_pizza_list');
        }

        return $this->render('admin_pizza/update.html.twig', [
            'form' => $form->createView(),
            'pizza' => $pizza,
        ]);
    }

    /**
     * @Route("/admin/pizza/list", name="app_admin_pizza_list", methods={"GET"})
     */
    public function list(): Response
    {
        $pizzas = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Pizza::class)
            ->findAll();

        $data = [];

        foreach ($pizzas as $pizza) {
            $form = $this->createForm(AdminPizzaType::class, $pizza, [
                'delete_mode' => true,
                'action' => $this->generateUrl('app_admin_pizza_delete', [
                    'id' => $pizza->getId(),
                ]),
            ]);

            $data[] = [
                'pizza' => $pizza,
                'form' => $form->createView(),
            ];
        }

        return $this->render('admin_pizza/list.html.twig', [
            'data' => $data,
        ]);
    }

    /**
     * @Route("/admin/pizza/{id}/delete", name="app_admin_pizza_delete", methods={"POST"})
     */
    public function delete(Pizza $pizza, Request $request): Response
    {
        $form = $this->createForm(AdminPizzaType::class, $pizza, [
            'delete_mode' => true,
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new BadRequestException(sprintf(
                'Impossible de supprimer la pizza %s',
                $pizza->getId(),
            ));
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($pizza);

        $manager->flush();

        return $this->redirectToRoute('app_admin_pizza_list');
    }
}
