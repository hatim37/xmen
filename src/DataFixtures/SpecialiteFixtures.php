<?php

namespace App\DataFixtures;

use App\Entity\Specialite;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Generator;

class SpecialitetFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_Fr');

        $specialites =[];
        for ($i=0; $i < 10; $i++) {
            $specialite = new Specialite();
            $specialite->setName($this->faker->userAgent());
            $specialites[] = $specialite;
            $manager->persist($specialite);
        }
    }
}
