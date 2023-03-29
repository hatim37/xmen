<?php

namespace App\DataFixtures;

use App\Entity\Agent;
use App\Entity\Cible;
use App\Entity\Contact;
use App\Entity\Nationalite;
use App\Entity\Pays;
use App\Entity\Planque;
use App\Entity\Specialite;
use App\Entity\Statut;
use App\Entity\TypeMission;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;


    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
   
    }

    public function load(ObjectManager $manager): void
    {

        
      

       //Users
       //user
       for ($i=0; $i < 10; $i++) { 
        $user = new User();
        $user->setName($this->faker->name())
            ->setFirstName($this->faker->userName())
            ->setEmail($this->faker->email())
            ->setRoles(['ROLE_ADMIN'])
            ->setPlainPassword('password');
            $manager->persist($user);   
    }
        

        $manager->flush();
    }
}
