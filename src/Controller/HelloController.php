<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    /**
     * @Route("/hello", name="app_hello_hello")
     */
    public function hello(): Response
    {
        return new Response('Bonjour tout le monde');
    }
}
