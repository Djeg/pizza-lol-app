<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Author;
use App\Entity\BookKind;
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
        $kinds = $this
            ->getDoctrine()
            ->getRepository(BookKind::class)
            ->findAll();

        return $this->render('admin/listBookKind.html.twig', [
            'kinds' => $kinds,
        ]);
    }

    /**
     * @Route("/admin/kinds/new", name="app_admin_newBookKind")
     */
    public function newBookKind(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $kind = (new BookKind())
                ->setName($request->request->get('name'));

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($kind);

            $manager->flush();

            return $this->redirectToRoute('app_admin_listBookKind');
        }

        return $this->render('admin/newBookKind.html.twig');
    }

    /**
     * @Route("/admin/kinds/{id}", name="app_admin_modifyBookKind")
     */
    public function modifyBookKind(BookKind $kind, Request $request): Response
    {
        $success = false;

        if ($request->isMethod(Request::METHOD_POST)) {
            $kind->setName($request->request->get('name'));

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($kind);

            $manager->flush();

            $success = true;
        }

        return $this->render('admin/modifyBookKind.html.twig', [
            'kind' => $kind,
            'success' => $success,
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
        $authors = $this
            ->getDoctrine()
            ->getRepository(Author::class)
            ->findAll();

        return $this->render('admin/listAuthors.html.twig', [
            'authors' => $authors,
        ]);
    }

    /**
     * @Route("/admin/authors/new", name="app_admin_newAuthor")
     */
    public function newAuthor(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $author = (new BookKind())
                ->setName($request->request->get('name'));

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($author);

            $manager->flush();

            return $this->redirectToRoute('app_admin_newAuthor');
        }

        return $this->render('admin/newAuthor.html.twig');
    }

    /**
     * @Route("/admin/kinds/{id}", name="app_admin_modifyBookKind")
     */
    //public function modifyBookKind(BookKind $kind, Request $request): Response
    //{
    //    $success = false;

    //    if ($request->isMethod(Request::METHOD_POST)) {
    //        $kind->setName($request->request->get('name'));

    //        $manager = $this->getDoctrine()->getManager();

    //        $manager->persist($kind);

    //        $manager->flush();

    //        $success = true;
    //    }

    //    return $this->render('admin/modifyBookKind.html.twig', [
    //        'kind' => $kind,
    //        'success' => $success,
    //    ]);
    //}

    /**
     * @Route("/admin/kinds/{id}/delete", name="app_admin_deleteBookKind")
     */
    //public function deleteBookKind(BookKind $kind): Response
    //{
    //    $manager = $this->getDoctrine()->getManager();

    //    $manager->remove($kind);

    //    $manager->flush();

    //    return $this->render('admin/deleteBookKind.html.twig', [
    //        'kind' => $kind,
    //    ]);
    //}
}
