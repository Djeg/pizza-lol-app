<?php

namespace App\Form\Front;

use App\DTO\CreditCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreditCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $today = new \DateTime();
        $year = (int)$today->format('Y');

        $builder
            ->add('numbers', NumberType::class, [
                'label' => 'Numéro :',
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom et prénom :',
            ])
            ->add('expirationMonth', ChoiceType::class, [
                'label' => 'Mois d\'éxpiration :',
                'choices' => array_reduce(range(1, 12), function (array $acc, int $month) {
                    $acc[$month] = $month;

                    return $acc;
                }, []),
            ])
            ->add('expirationYear', ChoiceType::class, [
                'label' => 'Année d\'éxpiration :',
                'choices' => array_reduce(array_reverse(range($year, $year + 50)), function (array $acc, int $y) {
                    $acc[$y] = $y;

                    return $acc;
                }, []),
            ])
            ->add('cryptogram', NumberType::class, [
                'label' => 'Cryptogramme de sécurité :',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Payer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreditCard::class,
        ]);
    }
}
