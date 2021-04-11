<?php

namespace App\Controller\Admin;

use App\Entity\Pizza;
use App\Form\AdminPizzaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

/**
 * @Route("/admin/pizza")
 */
class PizzaController extends AbstractController
{
    /**
     * @Route("/create", name="app_admin_pizza_create", methods={"GET", "POST"})
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

        return $this->render('admin/pizza/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/update", name="app_admin_pizza_update", methods={"GET", "POST"})
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

        return $this->render('admin/pizza/update.html.twig', [
            'form' => $form->createView(),
            'pizza' => $pizza,
        ]);
    }

    /**
     * @Route("/list", name="app_admin_pizza_list", methods={"GET"})
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

        return $this->render('admin/pizza/list.html.twig', [
            'data' => $data,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="app_admin_pizza_delete", methods={"POST"})
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
