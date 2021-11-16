<?php

namespace App\Form\Front;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Category;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class NewBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du livre :',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du livre :',
            ])
            ->add('shortDescription', TextType::class, [
                'label' => 'Description courte du livre :',
            ])
            ->add('image', TextType::class, [
                'label' => 'Image (url) :',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix :',
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie :',
                'class' => Category::class,
                'choice_label' => 'title',
            ])
            ->add('author', EntityType::class, [
                'label' => 'Auteur :',
                'class' => Author::class,
                'choice_label' => 'fullName',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Revendre ce livre',
            ])
        ;

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($options) {
            $event->getForm()->getData()->setDealer($options['user']);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('user');
        $resolver->setAllowedTypes('user', User::class);

        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
