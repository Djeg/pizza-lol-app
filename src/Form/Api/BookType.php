<?php

namespace App\Form\Api;

use App\Entity\Book;
use App\Form\Admin\BookType as AdminBookType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AdminBookType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder->remove('submit');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): ?string
    {
        return '';
    }
}
