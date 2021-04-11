<?php

namespace App\DataFixtures;

use App\Entity\Pizza;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PizzaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $regina = new Pizza();
        $regina->setName('Régina');
        $regina->setPrice(9.7);

        $vegan = new Pizza();
        $vegan->setName('Végétarienne');
        $vegan->setPrice(10.5);

        $napolitan = new Pizza();
        $napolitan->setName('Napolitaine');
        $napolitan->setPrice(11.5);

        $manager->persist($regina);
        $manager->persist($vegan);
        $manager->persist($napolitan);

        $manager->flush();
    }
}
