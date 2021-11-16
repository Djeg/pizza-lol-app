<?php

namespace App\Controller\Front;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/mon-profile', name: 'app_front_user_profile')]
    #[IsGranted('ROLE_USER')]
    public function profile(): Response
    {
        return $this->render('front/user/profile.html.twig');
    }

    #[Route('/revendeur/{id}', name: 'app_front_user_showDealer')]
    public function showDealer(User $dealer): Response
    {
        if ($this->getUser() && $this->getUser()->getEmail() === $dealer->getEmail()) {
            return $this->redirectToRoute('app_front_user_profile');
        }

        return $this->render('front/user/showDealer.html.twig', [
            'dealer' => $dealer,
        ]);
    }
}
