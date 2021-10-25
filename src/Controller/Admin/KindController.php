<?php

namespace App\Controller\Admin;

use App\Entity\Kind;
use App\Form\Admin\KindType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KindController extends CRUDController
{
    #[Route('/admin/genres', name: 'app_admin_kind_index')]
    public function index(): Response
    {
        return $this->list('kind', Kind::class, 'kinds');
    }

    #[Route('/admin/genres/nouveau', name: 'app_admin_kind_create')]
    public function create(): Response
    {
        return $this->createOrUpdate('kind', KindType::class, null, function (Kind $kind) {
            return "Le genre {$kind->getName()} à bien été créé";
        });
    }

    #[Route('/admin/genres/{id}', name: 'app_admin_kind_update')]
    public function update(Kind $kind, Request $request): Response
    {
        return $this->createOrUpdate('kind', KindType::class, $kind, function (Kind $kind) {
            return "Le genre {$kind->getName()} à bien été modifié";
        });
    }

    #[Route('/admin/genres/{id}/supprimer', name: 'app_admin_kind_delete')]
    public function delete(Kind $kind): Response
    {
        return $this->remove('kind', $kind, function (Kind $kind) {
            return "Le genre {$kind->getName()} à bien été supprimé";
        });
    }
}
