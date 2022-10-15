<?php

namespace App\DataFixtures;

use App\Entity\Fp;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class Fps extends Fixture
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
            $fp = new Fp();
            $fp->setNombre($this->faker->word())
                ->setDistancia($this->faker->numberBetween(1,50))
                ->setNplazos($this->faker->numberBetween(1,50))
                ->setCodeempresa($this->faker->numberBetween(1,50));
            $manager->persist($fp);
        }
        $manager->flush();
    }
}
