<?php

namespace App\Controller\Frontend;

use App\Controller\BaseController;
use App\Entity\Book;
use App\Form\Frontend\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends BaseController
{
    #[Route('/commentaires/{id}/ajouter', name: 'app_frontend_comment_add', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function add(Book $book): Response
    {
        $form = $this->createAndHandleForm(CommentType::class);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->redirectToRoute('app_frontend_book_display', [
                'id' => $book->getId(),
                'errors' => $form->getErrors(),
            ]);
        }

        $comment = $form->getData();

        $comment->setUser($this->getUser());
        $comment->setBook($book);

        $this->persistAndFlush($comment);

        return $this->redirectToRoute('app_frontend_book_display', [
            'id' => $book->getId(),
        ]);
    }
}
