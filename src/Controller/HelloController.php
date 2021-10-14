<?php

declare(strict_types=1);

namespace App\Controller;

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
        $response = new Response('<h1>Hello</h1>');

        $response->headers->set('Powered-By', 'david');

        $response->setStatusCode(404);

        var_dump($request->getMethod());
        var_dump($request->headers->get('User-Agent'));
        var_dump($request->headers->get('Accept-Language'));
        var_dump($request->query->get('test'));

        return $response;
    }

    /**
     * @Route("/bonjour/{param1}/{param2}", name="app_hello_bonjour")
     */
    public function bonjour(string $param1, string $param2): Response
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
