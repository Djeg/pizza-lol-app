<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Pizza;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminPizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (true === $options['delete_mode']) {
            $builder->add('submit', SubmitType::class, [
                'label' => 'Supprimer cette pizza',
            ]);

            return;
        }


        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la pizza',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix de la pizza',
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
            'delete_mode' => false,
        ]);
    }
}
