<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Form\Api\UserType;
use App\Form\Api\SearchUserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends ApiController
{
    #[Route('/api/users', name: 'app_api_user_collection', methods: ['GET'])]
    public function collection(): Response
    {
        return $this->getCollection(SearchUserType::class, User::class);
    }

    #[Route('/api/users/{id}', name: 'app_api_user_document', methods: ['GET'])]
    public function document(User $user): Response
    {
        return $this->getDocument($user);
    }

    #[Route('/api/users', name: 'app_api_user_create', methods: ['POST'])]
    public function create(): Response
    {
        return $this->createDocument(UserType::class);
    }

    #[Route('/api/users/{id}', name: 'app_api_user_update', methods: ['PATCH'])]
    public function update(User $user): Response
    {
        return $this->updateDocument($user, UserType::class);
    }

    #[Route('/api/users/{id}', name: 'app_api_user_delete', methods: ['DELETE'])]
    public function delete(User $user): Response
    {
        return $this->deleteDocument($user);
    }
}
