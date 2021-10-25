<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\Admin\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/admin/utilisateurs', name: 'app_admin_user_index')]
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/admin/utilisateurs/nouveau', name: 'app_admin_user_create')]
    public function create(Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setPassword($hasher->hashPassword($user, $user->getPassword()));

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($user);

            $manager->flush();

            return $this->redirectToRoute('app_admin_user_index', [
                'success' => "L'utilisateur {$user->getEmail()} à bien été créé",
            ]);
        }

        return $this->render('admin/user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/utilisateurs/{id}', name: 'app_admin_user_update')]
    public function update(User $user, Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $form = $this->createForm(UserType::class, $user, [
            'modify_mode' => true,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            if ($form->get('password')->getData()) {
                $user->setPassword($hasher->hashPassword($user, $user->getPassword()));
            }

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($user);

            $manager->flush();

            return $this->redirectToRoute('app_admin_user_index', [
                'success' => "L'utilisateur {$user->getEmail()} à bien été mis à jour",
            ]);
        }

        return $this->render('admin/user/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/utilisateurs/{id}/supprimer', name: 'app_admin_user_delete')]
    public function delete(User $user): Response
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('app_admin_user_index', [
            'success' => "L'utilisateur {$user->getEmail()} à bien été supprimé",
        ]);
    }
}
