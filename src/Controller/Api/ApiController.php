<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends BaseController
{
    public function getCollection(string $searchFormType, string $entityType): Response
    {
        $form = $this->createAndHandleForm($searchFormType);

        $repository = $this->getDoctrine()->getRepository($entityType);

        $entities = $repository->findAllByCriteria($form->getData());

        return $this->json($entities);
    }

    public function getDocument(object $document): Response
    {
        return $this->json($document);
    }

    public function createDocument(string $formType): Response
    {
        $form = $this->createAndHandleForm($formType);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $this->persistAndFlush($data);

            return $this->json($data, 201);
        }

        return $this->json([
            'errors' => $form->getErrors(),
        ], 400);
    }

    public function updateDocument(object $document, string $formType): Response
    {
        $form = $this->createAndHandleForm($formType, $document, [
            'method' => 'PATCH'
        ]);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistAndFlush($form->getData());

            return $this->json($document, 200);
        }

        return $this->json([
            'errors' => $form->getErrors(),
        ], 400);
    }

    public function deleteDocument(object $document): Response
    {
        $this->removeAndFlush($document);

        return $this->json($document);
    }
}
