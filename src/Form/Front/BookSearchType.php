<?php

namespace App\Form\Front;

use App\DTO\BookSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Par titre :',
                'required' => false,
            ])
            ->add('author', TextType::class, [
                'label' => 'Par auteur :',
                'required' => false,
            ])
            ->add('dealer', TextType::class, [
                'label' => 'Par revendeur :',
                'required' => false,
            ])
            ->add('minPrice', MoneyType::class, [
                'label' => 'Prix minimum :',
                'required' => false,
            ])
            ->add('maxPrice', MoneyType::class, [
                'label' => 'Prix maximum',
                'required' => false,
            ])
            ->add('category', TextType::class, [
                'label' => 'Par catégorie :',
                'required' => false,
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Nombre de résultat maximum :',
            ])
            ->add('orderBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'choices' => [
                    'Date' => 'updatedAt',
                    'Prix' => 'price',
                    'Titre' => 'title',
                ]
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du trie :',
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Lancer la recherche',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookSearchCriteria::class,
            'data' => new BookSearchCriteria(),
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
