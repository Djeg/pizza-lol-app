<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\User;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends ApiController
{
    #[Route('/api/token', name: "app_api_security_token", methods: ['POST'])]
    public function token(Request $request, UserPasswordHasherInterface $hasher)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $repository = $this->getDoctrine()->getRepository(User::class);

        $user = $repository->findOneBy([
            'email' => $email,
        ]);

        if (null === $user) {
            return $this->json([
                'error' => 'Invalid email',
            ], 400);
        }

        if (!$hasher->isPasswordValid($user, $password)) {
            return $this->json([
                'error' => 'Invalid password',
            ], 400);
        }

        $token = JWT::encode([
            'email' => $user->getEmail(),
        ], 'coucou');

        return $this->json([
            'token' => $token,
        ], 201);
    }
}
