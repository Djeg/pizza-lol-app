<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Comment;
use App\Entity\Kind;
use App\Entity\Order;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\CommentRepository;
use App\Repository\KindRepository;
use App\Repository\OrderRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    /**
     * Persist an entity
     */
    public function persist(object $data): self
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->persist($data);

        return $this;
    }

    /**
     * Flush all doctrine operations
     */
    public function flush(): self
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->flush();

        return $this;
    }

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

    /**
     * Retrieve the author repository
     */
    public function getAuthorRepository(): AuthorRepository
    {
        return $this->getDoctrine()->getManager()->getRepository(Author::class);
    }

    /**
     * Retrieve the book repository
     */
    public function getBookRepository(): BookRepository
    {
        return $this->getDoctrine()->getManager()->getRepository(Book::class);
    }

    /**
     * Retrieve the kind repository
     */
    public function getKindRepository(): KindRepository
    {
        return $this->getDoctrine()->getManager()->getRepository(Kind::class);
    }

    /**
     * Retrieve the order repository
     */
    public function getOrderRepository(): OrderRepository
    {
        return $this->getDoctrine()->getManager()->getRepository(Order::class);
    }

    /**
     * Retrieve the comment repository
     */
    public function getCommentRepository(): CommentRepository
    {
        return $this->getDoctrine()->getManager()->getRepository(Comment::class);
    }
}
