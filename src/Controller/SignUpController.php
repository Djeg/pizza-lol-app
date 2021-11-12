<?php

namespace App\Controller;

use App\Form\SignUpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SignUpController extends AbstractController
{
    /**
     * @Route("/inscription", name="sign_up")
     */
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(SignUpType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $user->setPassword($hasher->hashPassword($user, $user->getPassword()));

            $manager->persist($user);

            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('sign_up/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
