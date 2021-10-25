<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Form\FormInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    /**
     * Persist and flush an entity
     */
    public function persistAndFlush(object $data): self
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->persist($data);

        $manager->flush();

        return $this;
    }

    /**
     * Remove and flush an entity
     */
    public function removeAndFlush(object $data): self
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($data);

        $manager->flush();

        return $this;
    }

    /**
     * Create a form and handle the request
     */
    public function createAndHandleForm(string $formType, $data = null, array $options = []): FormInterface
    {
        $form = $this->createForm($formType, $data, $options);

        $form->handleRequest($this->container->get('request_stack')->getCurrentRequest());

        return $form;
    }
}
