<?php

namespace App\Form;

use App\DTO\ArticleSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleSearchType extends AbstractType
{
    /**
     * C'est une méthode qui permet de définir les champs du formulaires.
     * Pour définir les champs du formulaire, nous utilison un object
     * FormBuilderInterface
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('search', TextType::class, [
                'label' => 'Rechercher par titre :',
                'required' => false,
            ])
            ->add('authorName', TextType::class, [
                'label' => 'Rechercher par auteur :',
                'required' => false,
            ])
            ->add('orderBy', ChoiceType::class, [
                'label' => 'Trier par :',
                'choices' => [
                    'Identifiant' => 'id',
                    'Titre' => 'title',
                    'Date de création' => 'createdAt',
                    'Date de mise à jour' => 'updatedAt',
                ],
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du trie :',
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Nombre de résultat par page :',
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page :',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleSearchCriteria::class,
            'method' => 'GET',
            'data' => new ArticleSearchCriteria(),
        ]);
    }
}
