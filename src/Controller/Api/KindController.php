<?php

namespace App\Controller\Api;

use App\Entity\Kind;
use App\Form\Api\KindType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class KindController extends AbstractController
{
    #[Route('/api/kinds', name: 'app_api_kind_collection', methods: ['GET'])]
    public function collection(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Kind::class);

        $kinds = $repository->findAll();

        return $this->json($kinds);
    }

    #[Route('/api/kinds/{id}', name: 'app_api_kind_document', methods: ['GET'])]
    public function document(Kind $kind): Response
    {
        return $this->json($kind);
    }

    #[Route('/api/kinds', name: 'app_api_kind_create', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $form = $this->createForm(KindType::class);

        $form->handleRequest($request);

        $manager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $kind = $form->getData();

            $manager->persist($kind);
            $manager->flush();

            return $this->json($kind, 201);
        }

        return $this->json([
            'errors' => $form->getErrors(),
        ], 400);
    }

    #[Route('/api/kinds/{id}', name: 'app_api_kind_update', methods: ['PATCH'])]
    public function update(Kind $kind, Request $request): Response
    {
        $form = $this->createForm(KindType::class, $kind, [
            'method' => 'PATCH',
        ]);

        $form->handleRequest($request);

        $manager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $kind = $form->getData();

            $manager->persist($kind);
            $manager->flush();

            return $this->json($kind, 200);
        }

        return $this->json([
            'errors' => $form->getErrors(),
        ], 400);
    }

    #[Route('/api/kinds/{id}', name: 'app_api_kind_delete', methods: ['DELETE'])]
    public function delete(Kind $kind, Request $request): Response
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($kind);
        $manager->flush();

        return $this->json($kind);
    }
}
