<?php

namespace App\Form\Api;

use App\DTO\KindSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchKindType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', NumberType::class, [
                'required' => false,
                'empty_data' => 20,
            ])
            ->add('page', NumberType::class, [
                'required' => false,
                'empty_data' => 1,
            ])
            ->add('name', TextType::class, [
                'required' => false,
            ])
            ->add('orderBy', ChoiceType::class, [
                'choices' => [
                    'updatedAt' => 'updatedAt',
                    'name' => 'name',
                    'id' => 'id',
                ],
                'empty_data' => 'updatedAt',
                'required' => false,
            ])
            ->add('direction', ChoiceType::class, [
                'choices' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC',
                ],
                'empty_data' => 'DESC',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => KindSearchCriteria::class,
            'data' => new KindSearchCriteria(),
            'csrf_protection' => false,
            'method' => 'GET',
        ]);
    }

    public function getBlockPrefix(): ?string
    {
        return '';
    }
}
