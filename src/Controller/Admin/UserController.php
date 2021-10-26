<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\Admin\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends CRUDController
{
    #[Route('/admin/utilisateurs', name: 'app_admin_user_index')]
    public function index(): Response
    {
        return $this->list('user', User::class, 'users');
    }

    #[Route('/admin/utilisateurs/nouveau', name: 'app_admin_user_create')]
    public function create(): Response
    {
        return $this->createOrUpdate('user', UserType::class, null, function (User $user) {
            return "L'utilisateur {$user->getEmail()} à bien été créé";
        });
    }

    #[Route('/admin/utilisateurs/{id}', name: 'app_admin_user_update')]
    public function update(User $user): Response
    {
        return $this->createOrUpdate('user', UserType::class, $user, function (User $user) {
            return "L'utilisateur {$user->getEmail()} à bien été mis à jour";
        });
    }

    #[Route('/admin/utilisateurs/{id}/supprimer', name: 'app_admin_user_delete')]
    public function delete(User $user): Response
    {
        return $this->remove('user', $user, function (User $user) {
            return "L'utilisateur {$user->getEmail()} à bien été supprimé";
        });
    }
}
