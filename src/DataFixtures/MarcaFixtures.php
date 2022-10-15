<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Marca;
class MarcaFixtures extends Fixture
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
        for ($i=0; $i < 20; $i++) { 
            $marca=new Marca();
            $marca->setNombremarca($this->faker->word())
            ->setRutalogo($this->faker->word());
            $manager->persist($marca);
        }
        $manager->flush();
    }
}
