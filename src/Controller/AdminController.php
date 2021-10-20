<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Author;
use App\Entity\BookKind;
use App\Form\AuthorType;
use App\Form\BookKindType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/kinds", name="app_admin_listBookKind")
     */
    public function listBookKind(): Response
    {
        return $this->list(BookKind::class, 'listBookKind');
    }

    /**
     * @Route("/admin/kinds/new", name="app_admin_newBookKind")
     */
    public function newBookKind(Request $request): Response
    {
        $form = $this->createForm(BookKindType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kind = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($kind);

            $manager->flush();

            return $this->redirectToRoute('app_admin_listBookKind');
        }

        return $this->render('admin/newBookKind.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/kinds/{id}", name="app_admin_modifyBookKind")
     */
    public function modifyBookKind(BookKind $kind, Request $request): Response
    {
        $success = false;
        $form = $this->createForm(BookKindType::class, $kind);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $kind = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($kind);

            $manager->flush();

            $success = true;
        }

        return $this->render('admin/modifyBookKind.html.twig', [
            'kind' => $kind,
            'success' => $success,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/kinds/{id}/delete", name="app_admin_deleteBookKind")
     */
    public function deleteBookKind(BookKind $kind): Response
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($kind);

        $manager->flush();

        return $this->render('admin/deleteBookKind.html.twig', [
            'kind' => $kind,
        ]);
    }

    /**
     * @Route("/admin/authors", name="app_admin_listAuthor")
     */
    public function listAuthors(): Response
    {
        return $this->list(Author::class, 'listAuthors');
    }

    /**
     * @Route("/admin/authors/new", name="app_admin_newAuthor")
     */
    public function newAuthor(Request $request): Response
    {
        $form = $this->createForm(AuthorType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($author);

            $manager->flush();

            return $this->redirectToRoute('app_admin_newAuthor');
        }

        return $this->render('admin/newAuthor.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/authors/{id}", name="app_admin_modifyAuthor")
     */
    public function modifyAuthor(Author $author, Request $request): Response
    {
        $form = $this->createForm(AuthorType::class, $author);

        $success = false;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($author);

            $manager->flush();

            $success = true;
        }

        return $this->render('admin/modifyAuthor.html.twig', [
            'kind' => $author,
            'success' => $success,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/authors/{id}/delete", name="app_admin_deleteAuthor")
     */
    public function deleteAuthor(Author $author): Response
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($author);

        $manager->flush();

        return $this->render('admin/deleteAuthor.html.twig', [
            'author' => $author,
        ]);
    }


    /**
     * Liste une entité
     */
    private function list(string $className, string $templateName): Response
    {
        $entities = $this
            ->getDoctrine()
            ->getRepository($className)
            ->findAll();

        return $this->render('admin/' . $templateName . '.html.twig', [
            'entities' => $entities,
        ]);
    }
}
