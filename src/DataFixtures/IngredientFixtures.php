<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ingredients = [
            ['name' => 'Sauce tomate', 'price' => 0.2],
            ['name' => 'Tomates', 'price' => 0.5],
            ['name' => 'Jambon', 'price' => 1],
            ['name' => 'Olive', 'price' => 1],
            ['name' => 'Chorizo', 'price' => 1],
            ['name' => 'Crème fraîche', 'price' => 0.4],
            ['name' => 'Mozzarella', 'price' => 0.5],
            ['name' => 'Gruyère', 'price' => 0.5],
        ];

        foreach ($ingredients as ['name' => $name, 'price' => $price]) {
            $ingredient = new Ingredient();
            $ingredient->setName($name);
            $ingredient->setPrice($price);

            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
