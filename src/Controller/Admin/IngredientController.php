<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
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
}
