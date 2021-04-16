<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Form\AdminIngredientType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IngredientController extends AbstractController
{
    /**
     * @Route("/admin/ingredients/list", name="app_admin_ingredient_list")
     */
    public function list(): Response
    {
        $ingredients = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Ingredient::class)
            ->findAll();

        return $this->render('admin/ingredient/list.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }

    /**
     * @Route("/admin/ingredients/create", name="app_admin_ingredient_create")
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(AdminIngredientType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($ingredient);
            $manager->flush();

            return $this->redirectToRoute('app_admin_ingredient_list');
        }

        $formView = $form->createView();

        return $this->render('admin/ingredient/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    /**
     * @Route("/admin/ingredients/{id}/delete", name="app_admin_ingredient_delete")
     */
    public function delete(Ingredient $ingredient): Response
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($ingredient);
        $manager->flush();

        return $this->redirectToRoute('app_admin_ingredient_list');
    }
}
