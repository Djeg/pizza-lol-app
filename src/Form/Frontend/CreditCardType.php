<?php

namespace App\Form\Frontend;

use App\DTO\CreditCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreditCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom et prénom :'
            ])
            ->add('number', NumberType::class, [
                'label' => 'Numéro :',
            ])
            ->add('expirationMonth', NumberType::class, [
                'label' => 'Mois d\'éxpiration :',
            ])
            ->add('expirationYear', NumberType::class, [
                'label' => 'Année d\'éxpiration :',
            ])
            ->add('cryptogram', NumberType::class, [
                'label' => 'Cryptogramme de sécurité :'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Payer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreditCard::class,
        ]);
    }
}
