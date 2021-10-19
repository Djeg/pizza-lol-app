<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\BookKind;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/kinds", name="app_admin_listBookKind")
     */
    public function listBookKind(): Response
    {
        // @TODO ajouter le vrai code

        return new Response('@todo');
    }

    /**
     * @Route("/admin/kinds/new", name="app_admin_newBookKind")
     */
    public function newBookKind(): Response
    {
        // @TODO ajouter le vrai code

        return new Response('@todo');
    }

    /**
     * @Route("/admin/kinds/{id}", name="app_admin_modifyBookKind")
     */
    public function modifyBookKind(BookKind $kind): Response
    {
        // @TODO ajouter le vrai code

        return new Response('@todo');
    }

    /**
     * @Route("/admin/kinds/{id}/delete", name="app_admin_deleteBookKind")
     */
    public function deleteBookKind(BookKind $kind): Response
    {
        // @TODO ajouter le vrai code

        return new Response('@todo');
    }
}
