<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Pizza;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function create(Request $request): Response
    {
        $method = $request->getMethod();

        if ('POST' === $method) {
            // On remplie notre entité
            $pizza = new Pizza();
            $pizza->setName($request->request->get('name'));
            $pizza->setDescription($request->request->get('description'));
            $pizza->setPrice((float)$request->request->get('price'));
            $pizza->setImage($request->request->get('image'));

            // On récupére l'entity manager
            $manager = $this->getDoctrine()->getManager();

            // On persiste notre pizza. On enregistre la pizza
            // dans notre manager
            $manager->persist($pizza);

            // Transmet tout à la base de données
            $manager->flush();

            // Rediriger vers display
            return $this->redirectToRoute('app_pizza_display', [
                'id' => $pizza->getId(),
            ]);
        }

        return $this->render('pizza/create.html.twig');
    }

    /**
     * @Route("/pizza/{id}", name="app_pizza_display")
     */
    public function display(int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Pizza::class);

        $pizza = $repository->find($id);

        return $this->render('pizza/display.html.twig', [
            'pizza' => $pizza,
        ]);
    }
}
