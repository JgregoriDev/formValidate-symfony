<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Origengasto;
use Faker\Factory;
use Faker\Generator;

class OrigenGastoFixtures extends Fixture
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create();
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 20; $i++) {
            $og = new Origengasto();
            $og->setCuenta($this->faker->randomLetter())
                ->setDescripcion($this->faker->words(1, true))
                ->setEsinmolizado(false);
            $manager->persist($og);
            $manager->flush();
        }
    }
}
