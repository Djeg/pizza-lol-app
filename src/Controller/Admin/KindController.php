<?php

namespace App\Controller\Admin;

use App\Entity\Kind;
use App\Form\Admin\KindType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class KindController extends AbstractController
{
    #[Route('/admin/genres', name: 'app_admin_kind_index')]
    public function index(): Response
    {
        $kinds = $this->getDoctrine()->getRepository(Kind::class)->findAll();

        return $this->render('admin/kind/index.html.twig', [
            'kinds' => $kinds,
        ]);
    }

    #[Route('/admin/genres/nouveau', name: 'app_admin_kind_create')]
    public function create(Request $request): Response
    {
        $form = $this->createForm(KindType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kind = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($kind);

            $manager->flush();

            return $this->redirectToRoute('app_admin_kind_index', [
                'success' => "Le genre {$kind->getName()} à bien été créé",
            ]);
        }

        return $this->render('admin/kind/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/genres/{id}', name: 'app_admin_kind_update')]
    public function update(Kind $kind, Request $request): Response
    {
        $form = $this->createForm(KindType::class, $kind);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kind = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($kind);

            $manager->flush();

            return $this->redirectToRoute('app_admin_kind_index', [
                'success' => "Le genre {$kind->getName()} à bien été mis à jour",
            ]);
        }

        return $this->render('admin/kind/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/genres/{id}/supprimer', name: 'app_admin_kind_delete')]
    public function delete(Kind $kind): Response
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($kind);
        $manager->flush();

        return $this->redirectToRoute('app_admin_kind_index', [
            'success' => "Le genre {$kind->getName()} à bien été supprimé",
        ]);
    }
}
