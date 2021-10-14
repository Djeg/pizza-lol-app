<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 1. Créer un controller "HomeController"
 * 
 * 2. Hérité du AbstractController !
 * 
 * 3. Créer une méthode "home" avec la route "/"
 * 
 * 4. Créé et afficher son template
 */

class CalculController extends AbstractController
{
    /**
     * @Route("/calcul/add/{a}/{b}", name="app_calcul_add")
     */
    public function add(int $a, int $b): Response
    {
        $resultat = $a + $b;

        return $this->render('calcul/add.html.twig', [
            'a' => $a,
            'b' => $b,
            'resultat' => $resultat,
        ]);
    }

    /**
     * @Route("/calcul/multiply/{a}/{b}", name="app_calcul_multiply")
     */
    public function multiply(int $a, int $b): Response
    {
        $resultat = $a * $b;

        return new Response('Le résultat est ' . $resultat);
    }

    /**
     * @Route("/calcul/subtract/{a}/{b}", name="app_calcul_subtract")
     */
    public function subtract(int $a, int $b): Response
    {
        $resultat = $a - $b;

        return new Response('Le résultat est ' . $resultat);
    }
}
