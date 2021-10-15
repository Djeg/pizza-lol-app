<?php

declare(strict_types=1);

namespace App\Controller;

// use App\Entity\Pizza;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home_home")
     */
    public function home(): Response
    {
        // $repository = $this->getDoctrine()->getRepository(Pizza::class);

        // pizzas = $repository->findAll();

        return $this->render('home/home.html.twig', [
            // 'pizzas' => $pizzas,
        ]);
    }
}
