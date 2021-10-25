<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;

/**
 * This controller contains the basic administration crud operations
 */
class CRUDController extends BaseController
{
    /**
     * List a given entity
     */
    protected function list(string $name, string $entityClass, string $viewName = 'entities'): Response
    {
        $entities = $this->getDoctrine()->getRepository($entityClass)->findAll();

        return $this->render('admin/' . $name . '/index.html.twig', [
            $viewName => $entities,
        ]);
    }

    /**
     * Create or update a new entity
     */
    protected function createOrUpdate(string $name, string $formType, object $data = null, ?callable $successHandler): Response
    {
        $form = $this->createAndHandleForm($formType, $data);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $form->getData();

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($entity);

            $manager->flush();

            $options = [];

            if ($successHandler) {
                $options['success'] = $successHandler($entity);
            }

            return $this->redirectToRoute('app_admin_' . $name . '_index', $options);
        }

        return $this->render('admin/' . $name . '/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Remove an entity
     */
    protected function remove(string $name, object $data, ?callable $successHandler): Response
    {
        $this->removeAndFlush($data);

        $options = [];

        if ($successHandler) {
            $options['success'] = $successHandler($data);
        }

        return $this->redirectToRoute('app_admin_' . $name . '_index', $options);
    }
}
