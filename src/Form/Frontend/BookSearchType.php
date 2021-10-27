<?php

namespace App\Form\Frontend;

use App\DTO\BookSearchCriteria;
use App\Entity\Author;
use App\Entity\Kind;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', NumberType::class, [
                'label' => 'Nombre de résultat :',
                'required' => false,
                'empty_data' => 20,
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
                'required' => false,
                'empty_data' => 1,
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom :',
                'required' => false,
                'empty_data' => null,
            ])
            ->add('minPrice', MoneyType::class, [
                'label' => 'Prix minimum :',
                'required' => false,
                'empty_data' => null,
            ])
            ->add('maxPrice', MoneyType::class, [
                'label' => 'Prix maximum :',
                'required' => false,
                'empty_data' => null,
            ])
            ->add('author', EntityType::class, [
                'label' => 'Auteur :',
                'class' => Author::class,
                'choice_label' => 'name',
                'required' => false,
                'empty_data' => null,
            ])
            ->add('kinds', EntityType::class, [
                'label' => 'Genre :',
                'class' => Kind::class,
                'choice_label' => 'name',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'empty_data' => null,
            ])
            ->add('orderBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'choices' => [
                    'Date' => 'updatedAt',
                    'Titre' => 'title',
                    'Prix' => 'price',
                ],
                'required' => false,
                'empty_data' => 'updatedAt',
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du trie :',
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
                'required' => false,
                'empty_data' => 'DESC',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookSearchCriteria::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
