<?php

namespace App\Controller\Api;

use App\Entity\Kind;
use App\Form\Api\KindType;
use App\Form\Api\SearchKindType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KindController extends ApiController
{
    #[Route('/api/kinds', name: 'app_api_kind_collection', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function collection(): Response
    {
        return $this->getCollection(SearchKindType::class, Kind::class);
    }

    #[Route('/api/kinds/{id}', name: 'app_api_kind_document', methods: ['GET'])]
    public function document(Kind $kind): Response
    {
        return $this->getDocument($kind);
    }

    #[Route('/api/kinds', name: 'app_api_kind_create', methods: ['POST'])]
    public function create(): Response
    {
        return $this->createDocument(KindType::class);
    }

    #[Route('/api/kinds/{id}', name: 'app_api_kind_update', methods: ['PATCH'])]
    public function update(Kind $kind): Response
    {
        return $this->updateDocument($kind, KindType::class);
    }

    #[Route('/api/kinds/{id}', name: 'app_api_kind_delete', methods: ['DELETE'])]
    public function delete(Kind $kind): Response
    {
        return $this->deleteDocument($kind);
    }
}
