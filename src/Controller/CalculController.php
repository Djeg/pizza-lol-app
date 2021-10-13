<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculController
{
    /**
     * @Route("/calcul/add/{a}/{b}", name="app_calcul_add")
     */
    public function add(int $a, int $b): Response
    {
        $resultat = $a + $b;

        return new Response('Le résultat est ' . $resultat);
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
