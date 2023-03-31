<?php

namespace App\DataFixtures;

use App\Entity\Agent;
use App\Entity\Cible;
use App\Entity\Contact;
use App\Entity\Mission;
use App\Entity\Nationalite;
use App\Entity\Pays;
use App\Entity\Planque;
use App\Entity\Specialite;
use App\Entity\Statut;
use App\Entity\TypeMission;
use App\Entity\User;
use App\Repository\SpecialiteRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;
 
    private $specialiteRepository;

   


    public function __construct( SpecialiteRepository $specialiteRepository)
    {
        $this->faker = Factory::create('fr_FR');
        $this->specialiteRepository = $specialiteRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $specialites = $this->specialiteRepository->findAll();
        
        
       //Users
       $users = [];

       $admin = new User();
        $admin->setName('Administrateur')
            ->setFirstName('admin')
            ->SetEmail('admin@xmen.fr')
            ->setRoles(['ROLE_ADMIN'])
            ->setPlainPassword('password');

        $users[] = $admin;
        $manager->persist($admin);


       for ($i=0; $i < 10; $i++) { 
        $user = new User();
        $user->setName($this->faker->name())
            ->setFirstName($this->faker->userName())
            ->setEmail($this->faker->email())
            ->setRoles(['ROLE_ADMIN'])
            ->setPlainPassword('password');
            $users[] = $user;
            $manager->persist($user);
        }

        //nationalites
        $nationalites = [];
        for ($i = 0; $i < 30; $i++) {
            $nationalite = new Nationalite();
            $nationalite->setName($this->faker->country());
            $nationalites[] = $nationalite;
            $manager->persist($nationalite);
        }


        //Specialites
        $specialites =[];
        for ($i=0; $i < 20; $i++) { 
            $specialite = new Specialite();
            $specialite->setName($this->faker->jobTitle());
                $specialites[] = $specialite;
                $manager->persist($specialite);   
        }

        //agents
        $agents =[];
        for ($i=0; $i < 10; $i++) { 
            $agent = new Agent();
            $agent->setName($this->faker->name())
                ->setFirstName($this->faker->firstName())
                ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
                ->setIdentificationCode(mt_rand(0, 10000))
                ->setNationalite($nationalites[mt_rand(0, count($nationalites) - 1)]);
                $agents[] = $agent;
                $manager->persist($agent);
        }

        foreach ($specialites as $specialite) {
            for ($i = 0; $i < mt_rand(1, 5); $i++) {
                $specialite->addAgent(
                    $agents[mt_rand(0, count($agents) - 1)]
                );
            }
        }

        //pays
        $country =[];
        for ($i=0; $i < 15; $i++) { 
            $pays = new Pays();
            $pays->setName($this->faker->country())
                ->setNationalite($nationalites[mt_rand(0, count($nationalites) - 1)]);
                $country[] = $pays;
                $manager->persist($pays);   
        }

        //cibles
        $cibles =[];
        for ($i=0; $i < 20; $i++) { 
            $cible = new Cible();
            $cible->setName($this->faker->name())
                ->setFirstName($this->faker->firstName())
                ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
                ->setCodeName(mt_rand(0, 10000))
                ->setNationalite($nationalites[mt_rand(0, count($nationalites) - 1)]);
                $cibles[] = $cible;
                $manager->persist($cible);   
        }

        //contacts
        $contacts =[];
        for ($i=0; $i < 10; $i++) { 
            $contact = new Contact();
            $contact->setName($this->faker->name())
                ->setFirstName($this->faker->firstName())
                ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
                ->setCodeName(mt_rand(0, 10000))
                ->setNationalite($nationalites[mt_rand(0, count($nationalites) - 1)]);
                $contacts[] = $contact;
                $manager->persist($contact);   
        }

        //planques
        $planques =[];
        for ($i=0; $i < 20; $i++) { 
            $planque = new Planque();
            $planque->setCode(mt_rand(0, 10000))
                ->setAddress($this->faker->address())
                ->setPays($country[mt_rand(0, count($country) - 1)])
                ->setType($this->faker->citySuffix());
                $planques[] = $planque;
                $manager->persist($planque);   
        }

        //typeMisions
        $typeMisions =[];
        for ($i=0; $i < 10; $i++) { 
            $typeMision = new TypeMission();
            $typeMision->setName($this->faker->jobTitle());
                $typeMisions[] = $typeMision;
                $manager->persist($specialite);   
        }

        //statuts
        $statuts =[];
        for ($i=0; $i < 10; $i++) { 
            $statut = new Statut();
            $statut->setName(mt_rand(0, 2) === 1 ? 'En cours' : 'Terminée');
                $statuts[] = $statut;
                $manager->persist($specialite);   
        }


         $missions =[];
        for ($i=0; $i < 20; $i++) { 
            $mission = new Mission();
            $mission->setTitle($this->faker->words(1,true))
                ->setDescription($this->faker->text(100))
                ->setCodeName($this->faker->isbn10())
                ->setSpecialite($specialites[mt_rand(0, count($specialites) - 1)])
                ->setPlanque($planques[mt_rand(0, count($planques) - 1)])
                ->setPays($country[mt_rand(0, count($country) - 1)])
                ->setTypeMission($typeMisions[mt_rand(0, count($typeMisions) - 1)])
                ->setStatut($statuts[mt_rand(0, count($statuts) - 1)])
                ->setDateStart($this->faker->dateTimeBetween($startDate = '-2 months', $endDate = '-1 months', $timezone = null))
                ->setDateEnd($this->faker->dateTimeBetween($startDate = '0 months', $endDate = '1 months', $timezone = null));
                $missions[] = $mission;
                $manager->persist($mission);   
        }

        foreach ($agents as $mission) {
            for ($i = 0; $i < mt_rand(1, 5); $i++) {
                $mission->addMission(
                    $missions[mt_rand(0, count($missions) - 1)]
                );
            }
        }

        foreach ($cibles as $mission) {
            for ($i = 0; $i < mt_rand(1, 5); $i++) {
                $mission->addMission(
                    $missions[mt_rand(0, count($missions) - 1)]
                );
            }
        }

        foreach ($contacts as $mission) {
            for ($i = 0; $i < mt_rand(1, 5); $i++) {
                $mission->addMission(
                    $missions[mt_rand(0, count($missions) - 1)]
                );
            }
        }


        $manager->flush();
    }
}
