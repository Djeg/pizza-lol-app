<?php

namespace App\DataFixtures;

use App\Entity\Pizza;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PizzaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $sauceTomate = $this->getReference('Ingredient:Sauce tomate');
        $tomate = $this->getReference('Ingredient:Tomates');
        $jambon = $this->getReference('Ingredient:Jambon');

        $regina = new Pizza();
        $regina->setName('Régina');
        $regina->setPrice(9.7);
        $regina->addIngredient($sauceTomate);
        $regina->addIngredient($tomate);
        $regina->addIngredient($jambon);

        $vegan = new Pizza();
        $vegan->setName('Végétarienne');
        $vegan->setPrice(10.5);
        $vegan->addIngredient($sauceTomate);
        $vegan->addIngredient($tomate);

        $napolitan = new Pizza();
        $napolitan->setName('Napolitaine');
        $napolitan->setPrice(11.5);
        $napolitan->addIngredient($sauceTomate);
        $napolitan->addIngredient($tomate);
        $napolitan->addIngredient($jambon);

        $manager->persist($regina);
        $manager->persist($vegan);
        $manager->persist($napolitan);

        $manager->flush();
    }
}
