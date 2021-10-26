<?php

namespace App\Form\Field;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Allows to put images url inside a textarea and get back
 * all images as an array
 */
class ImagesType extends TextareaType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder->addModelTransformer(new CallbackTransformer(
            function ($imagesAsArray) {
                if (is_array($imagesAsArray)) {
                    return implode("\n", $imagesAsArray);
                }

                return null;
            },
            function ($imagesAsString) {
                return array_map(function ($url) {
                    return trim($url);
                }, explode("\n", $imagesAsString));
            },
        ));
    }
}
