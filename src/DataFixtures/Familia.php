<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Familia as FamiliaEntity;
use Faker\Factory;
use Faker\Generator;
class Familia extends Fixture
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
            $familia = new FamiliaEntity();
            $familia->setNombre($this->faker->words(3, true))
            ->setMargen($this->faker->numberBetween(1, 100))
            ->setIvapercent($this->faker->numberBetween(1, 100))
            ->setEsmanoobra($this->faker->words(3, true));
            $manager->persist($familia);
        }
        $manager->flush();
        $manager->flush();
    }
}
