<?php

namespace App\Form\Api;

use App\DTO\UserSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'required' => false,
                'empty_data' => 20,
            ])
            ->add('page', NumberType::class, [
                'required' => false,
                'empty_data' => 1,
            ])
            ->add('orderBy', ChoiceType::class, [
                'choices' => [
                    'email' => 'email',
                    'updatedAt' => 'updatedAt',
                    'id' => 'id',
                ],
                'required' => false,
                'empty_data' => 'updatedAt',
            ])
            ->add('direction', ChoiceType::class, [
                'choices' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC',
                ],
                'required' => false,
                'empty_data' => 'DESC',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserSearchCriteria::class,
            'data' => new UserSearchCriteria(),
            'csrf_protection' => false,
            'method' => 'GET',
        ]);
    }

    public function getBlockPrefix(): ?string
    {
        return '';
    }
}
