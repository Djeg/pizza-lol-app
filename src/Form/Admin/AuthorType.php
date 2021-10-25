<?php

namespace App\Form\Admin;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
            ])
            ->add('images', TextareaType::class, [
                'label' => 'Images (séparer les urls par des sauts de ligne) :',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ]);

        $builder->get('images')->addModelTransformer(new CallbackTransformer(
            function ($imagesAsArray) {
                return implode("\n", $imagesAsArray);
            },
            function ($imagesAsString) {
                return array_map(function ($url) {
                    return trim($url);
                }, explode("\n", $imagesAsString));
            },
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
