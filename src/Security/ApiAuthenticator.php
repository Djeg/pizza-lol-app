<?php

namespace App\Security;

use App\Repository\UserRepository;
use Exception;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class ApiAuthenticator extends AbstractAuthenticator
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function supports(Request $request): ?bool
    {
        return $request->headers->has('Authorization');
    }

    public function authenticate(Request $request): PassportInterface
    {
        // On récupére le token à l'intérieur de l'en tête Authorization
        $token = trim(str_replace('Bearer', '', $request->headers->get('Authorization')));

        // Décrypter le token pour optenir l'email
        try {
            $decodedToken = JWT::decode($token, 'coucou', ['HS256']);
            $email = $decodedToken->email;
        } catch (Exception $e) {
            throw new AuthenticationException('Invalid token');
        }

        // On vas rechercher l'utilisateur depuis le repository
        $user = $this->repository->findOneBy(['email' => $email]);

        if (null === $user) {
            throw new AuthenticationException('Invalid token');
        }

        // Valider l'authentification
        return new SelfValidatingPassport(new UserBadge($email));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // TODO: Implement onAuthenticationSuccess() method.
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new Response(json_encode([
            'error' => 'Invalid token',
        ]), 403, [
            'Content-Type' => 'application/json',
        ]);
    }

    //    public function start(Request $request, AuthenticationException $authException = null): Response
    //    {
    //        /*
    //         * If you would like this class to control what happens when an anonymous user accesses a
    //         * protected page (e.g. redirect to /login), uncomment this method and make this class
    //         * implement Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface.
    //         *
    //         * For more details, see https://symfony.com/doc/current/security/experimental_authenticators.html#configuring-the-authentication-entry-point
    //         */
    //    }
}
