<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * 1. Créer un controller PizzaController
 * 
 * 2. Ajouter une méthode "search" (/rechercher) qui retourne
 *    le template pizza/search.html.twig. Vous
 *    mettre ce que vous souhaitez à l'intérieur
 * 
 * 3. Ajouter une méthode "create" (/nouvelle-pizza) qui affiche
 *    le template pizza/create.html.twig. Vous
 *    mettre ce que vous souhaitez à l'intérieur
 * 
 * 3. Ajouter une méthode "display" (/pizza/{id}) qui affiche
 *    le template pizza/display.html.twig. Vous
 *    mettre ce que vous souhaitez à l'intérieur
 * 
 * 4. Créer un menu dans "base.html.twig" et faire en sorte
 *    de pouvoir naviguer sur toutes les pages.
 */

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home_home")
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }
}
