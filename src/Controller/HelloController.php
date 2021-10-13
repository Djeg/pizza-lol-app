<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 1. Créer un controller : "CalculController"
 * 
 * 2. Ajouter un méthode "add" qui accépte
 *    2 paramètre de type int, qui les additiones,
 *    et qui retourne une réponse: "Resultat : {le resultat}"
 * 
 * 3. Ajouter une méthode "multiply" qui fait la
 *    multiplication
 * 
 * 4. Ajouter un méthode "subtract" qui fais la
 *   soustraction
 */

class HelloController
{
    /**
     * @Route("/hello", name="app_hello_hello")
     */
    public function hello(): Response
    {
        return new Response('Bonjour tout le monde');
    }

    /**
     * @Route("/bonjour/{param1}", name="app_hello_bonjour")
     */
    public function bonjour(string $param1): Response
    {
        return new Response('Bonjour ' . $param1);
    }

    /**
     * @Route("/hello2/{param2}", name="app_hello_hello2")
     */
    public function hello2(int $param2 = 23): Response
    {
        return new Response('cocoucou tout le monde : ' . $param2);
    }
}
