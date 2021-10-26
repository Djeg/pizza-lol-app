<?php

namespace App\Form\Admin;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Kind;
use App\Form\Field\ImagesType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix :',
            ])
            ->add('images', ImagesType::class, [
                'label' => 'Images (séparer chaque image par une saut de ligne) :',
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'name',
                'label' => 'Auteur :',
            ])
            ->add('kind', EntityType::class, [
                'class' => Kind::class,
                'choice_label' => 'name',
                'label' => 'Genre :',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
