<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    /**
     * @Route("/hello", name="app_hello_hello")
     */
    public function hello(Request $request): Response
    {
        $name = $request->query->get('name', 'World');

        return new Response(sprintf('Hello %s !', $name));
    }
}
