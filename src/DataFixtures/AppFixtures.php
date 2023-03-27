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

        
        //Agents
        $xavier = new Agent;
        $xavier->setName('Xavier')
            ->setFirstName('Charles')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setIdentificationCode(mt_rand(0, 10000));
            $manager->persist($xavier);

        $cyclope = new Agent;
        $cyclope->setName('Cyclope')
            ->setFirstName('Scotts')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setIdentificationCode(mt_rand(0, 10000));
            $manager->persist($cyclope);

        $logan = new Agent;
        $logan->setName('Wolverine')
            ->setFirstName('Logan')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setIdentificationCode(mt_rand(0, 10000));
            $manager->persist($logan);

        $magneto = new Agent;
        $magneto->setName('Magneto')
            ->setFirstName('Erik')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setIdentificationCode(mt_rand(0, 10000));
            $manager->persist($magneto);
    
        $xavier = new Agent;
        $xavier->setName('Mystique')
            ->setFirstName('Raven')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setIdentificationCode(mt_rand(0, 10000));
            $manager->persist($xavier);

        $xavier = new Agent;
        $xavier->setName('Vif D\'argent')
            ->setFirstName('Peter')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setIdentificationCode(mt_rand(0, 10000));
            $manager->persist($xavier);

        $xavier = new Agent;
        $xavier->setName('Iceberg')
            ->setFirstName('Bobby')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setIdentificationCode(mt_rand(0, 10000));
            $manager->persist($xavier);

        $xavier = new Agent;
        $xavier->setName('Jean')
            ->setFirstName('Grey')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setIdentificationCode(mt_rand(0, 10000));
            $manager->persist($xavier);

        $xavier = new Agent;
        $xavier->setName('Diablo')
            ->setFirstName('Kurt')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setIdentificationCode(mt_rand(0, 10000));
            $manager->persist($xavier);

        $xavier = new Agent;
        $xavier->setName('Tornade')
            ->setFirstName('Ororo')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setIdentificationCode(mt_rand(0, 10000));
            $manager->persist($xavier);


        //Cibles   //----------------------------------------------------------------------------------

        $crapeau = new Cible;
        $crapeau->setName('Mortimer')
            ->setFirstName('Toynbee')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Le Crapaud');
            $manager->persist($crapeau);

        $sabertooth = new Cible;
        $sabertooth->setName('Creed')
            ->setFirstName('Victor')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Dent de Sabre');
            $manager->persist($sabertooth);
        
        $pyro = new Cible;
        $pyro->setName('John')
            ->setFirstName('Allerodyce')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Pyro');
            $manager->persist($pyro);

        $acier = new Cible;
        $acier->setName('Marko')
            ->setFirstName('Caïn')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Tête d\'acier');
            $manager->persist($acier);

        $multiple = new Cible;
        $multiple->setName('James')
            ->setFirstName('Madrox')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Multiple-Man');
            $manager->persist($multiple);

        $arclight = new Cible;
        $arclight->setName('Philippa')
            ->setFirstName('Sontag')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('PArclight');
            $manager->persist($arclight);

        
        $docteur = new Cible;
        $docteur->setName('Sébastian')
            ->setFirstName('Shaw')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Docteur');
            $manager->persist($docteur);
       
        $cinetique = new Cible;
        $cinetique->setName('Remy')
            ->setFirstName('LeBeau')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('force cinétique');
            $manager->persist($cinetique);

        $vipere = new Cible;
        $vipere->setName('Ophelia')
            ->setFirstName('Sarkissian')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Vipère');
            $manager->persist($vipere);

        $lady = new Cible;
        $lady->setName('Yuriko')
            ->setFirstName('Oyama')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Lady griffe');
            $manager->persist($lady);


        //Contact  //-----------------------------------------------------


        $iceberg = new Contact;
        $iceberg->setName('Bobby')
            ->setFirstName('Drake')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Iceberg');
            $manager->persist($iceberg);

        $rocket = new Contact;
        $rocket->setName('Sam')
            ->setFirstName('Guthrie ')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Rocket ');
            $manager->persist($rocket);
        
        $jubile = new Contact;
        $jubile->setName('Jubilation')
            ->setFirstName('Lee')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Jubilé');
            $manager->persist($jubile);

        $technokinesiste = new Contact;
        $technokinesiste->setName('Chris')
            ->setFirstName('Bradley')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Technokinésiste');
            $manager->persist($technokinesiste);

        $multiple = new Contact;
        $multiple->setName('James')
            ->setFirstName('Madrox')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Multiple-Man');
            $manager->persist($multiple);

        $fauve = new Contact;
        $fauve->setName('Hank')
            ->setFirstName('Philip')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Le fauve');
            $manager->persist($fauve);

        
        $X = new Contact;
        $X->setName('Laura')
            ->setFirstName('Kinney')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('X-23');
            $manager->persist($X);
       
        $yashida = new Contact;
        $yashida->setName('Mariko')
            ->setFirstName('Yashida')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('fille de Yashida');
            $manager->persist($yashida);

        $medecin = new Contact;
        $medecin->setName('Moira')
            ->setFirstName('Sarkissian')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Medecin');
            $manager->persist($medecin);

        $volante = new Contact;
        $volante->setName('Angel')
            ->setFirstName('Salvadore')
            ->setDateOfBirth($this->faker->dateTimeBetween($startDate = '-80 years', $endDate = '-22 years', $timezone = null))
            ->setCodeName('Volante');
            $manager->persist($volante);

        //Planque -----------------------------------------------

        $tunnel = new Planque;
        $tunnel->setCode(mt_rand(0, 10000))
            ->setAddress($this->faker->streetAddress())
            ->setType('Tunnel barrage d\'eau');
            $manager->persist($tunnel);

        $institut = new Planque;
        $institut->setCode(mt_rand(0, 10000))
            ->setAddress($this->faker->streetAddress())
            ->setType('Institut Xavier');
            $manager->persist($institut);

        $alcatraz = new Planque;
        $alcatraz->setCode(mt_rand(0, 10000))
            ->setAddress($this->faker->streetAddress())
            ->setType('Alcatraz');
            $manager->persist($alcatraz);

        $wagon = new Planque;
        $wagon->setCode(mt_rand(0, 10000))
            ->setAddress($this->faker->streetAddress())
            ->setType('Wagon marchandises');
            $manager->persist($wagon);

        $camionette = new Planque;
        $camionette->setCode(mt_rand(0, 10000))
            ->setAddress($this->faker->streetAddress())
            ->setType('Camionette pizza');
            $manager->persist($camionette);

        $eglise = new Planque;
        $eglise->setCode(mt_rand(0, 10000))
            ->setAddress($this->faker->streetAddress())
            ->setType('L\'ancienne église');
            $manager->persist($eglise);

        $acier = new Planque;
        $acier->setCode(mt_rand(0, 10000))
            ->setAddress($this->faker->streetAddress())
            ->setType('Usine d\'acier');
            $manager->persist($acier);

        $vaisseau = new Planque;
        $vaisseau->setCode(mt_rand(0, 10000))
            ->setAddress($this->faker->streetAddress())
            ->setType('Vaisseau furtif');
            $manager->persist($vaisseau);

        $peniche = new Planque;
        $peniche->setCode(mt_rand(0, 10000))
            ->setAddress($this->faker->streetAddress())
            ->setType('Péniche');
            $manager->persist($peniche);

        $egout = new Planque;
        $egout->setCode(mt_rand(0, 10000))
            ->setAddress($this->faker->streetAddress())
            ->setType('Port de pêche');
            $manager->persist($egout);

        //Spécialité -----------------------------------------------

        $tunnel = new Specialite;
        $tunnel->setName('Télépathie');
            $manager->persist($tunnel);

        $institut = new Specialite;
        $institut->setName('Rayon laser');
            $manager->persist($institut);

        $alcatraz = new Specialite;
        $alcatraz->setName('Griffe métalique');
            $manager->persist($alcatraz);

        $wagon = new Specialite;
        $wagon->setName('Magnétisme');
            $manager->persist($wagon);

        $camionette = new Specialite;
        $camionette->setName('Métamorphe');
            $manager->persist($camionette);

        $eglise = new Specialite;
        $eglise->setName('Super-vitesse');
            $manager->persist($eglise);

        $acier = new Specialite;
        $acier->setName('Cryokinésie');
            $manager->persist($acier);

        $vaisseau = new Specialite;
        $vaisseau->setName('Télékinésie');
            $manager->persist($vaisseau);

        $peniche = new Specialite;
        $peniche->setName('Téléportation');
            $manager->persist($peniche);

        $egout = new Specialite;
        $egout->setName('Controle la météo');
            $manager->persist($egout);

        
        //Nationalité -----------------------------------------------

     //   $tunnel = new Nationalite;
     //   $tunnel->setName('Belge');
     //       $manager->persist($tunnel);
//
     //   $institut = new Nationalite;
     //   $institut->setName('Canadienne');
     //       $manager->persist($institut);
//
     //   $alcatraz = new Nationalite;
     //   $alcatraz->setName('Italienne');
     //       $manager->persist($alcatraz);
//
     //   $wagon = new Nationalite;
     //   $wagon->setName('Japonaise');
     //       $manager->persist($wagon);
//
     //   $camionette = new Nationalite;
     //   $camionette->setName('Mexicaine');
     //       $manager->persist($camionette);
//
     //   $eglise = new Nationalite;
     //   $eglise->setName('Portugaise');
     //       $manager->persist($eglise);
//
     //   $acier = new Nationalite;
     //   $acier->setName('Serbe');
     //       $manager->persist($acier);
//
     //   $vaisseau = new Nationalite;
     //   $vaisseau->setName('Suisse');
     //       $manager->persist($vaisseau);
//
     //   $peniche = new Nationalite;
     //   $peniche->setName('Espagnole');
     //       $manager->persist($peniche);
//
     //   $egout = new Nationalite;
     //   $egout->setName('Roumaine');
     //       $manager->persist($egout);

        
            //Pays -----------------------------------------------

        $tunnel = new Pays;
        $tunnel->setName('Belgique');
            $manager->persist($tunnel);

        $institut = new Pays;
        $institut->setName('Canada');
            $manager->persist($institut);

        $alcatraz = new Pays;
        $alcatraz->setName('Italie');
            $manager->persist($alcatraz);

        $wagon = new Pays;
        $wagon->setName('Japon');
            $manager->persist($wagon);

        $camionette = new Pays;
        $camionette->setName('Mexique');
            $manager->persist($camionette);

        $eglise = new Pays;
        $eglise->setName('Portugal');
            $manager->persist($eglise);

        $acier = new Pays;
        $acier->setName('Serbie');
            $manager->persist($acier);

        $vaisseau = new Pays;
        $vaisseau->setName('Suisse');
            $manager->persist($vaisseau);

        $peniche = new Pays;
        $peniche->setName('Espagne');
            $manager->persist($peniche);

        $egout = new Pays;
        $egout->setName('Roumanie');
            $manager->persist($egout);

        //Mission type -----------------------------------------------

        $tunnel = new TypeMission;
        $tunnel->setName('Observation');
            $manager->persist($tunnel);

        $institut = new TypeMission;
        $institut->setName('Infiltration');
            $manager->persist($institut);

        $alcatraz = new TypeMission;
        $alcatraz->setName('Renseignement');
            $manager->persist($alcatraz);

        $wagon = new TypeMission;
        $wagon->setName('Evacuation');
            $manager->persist($wagon);

        $camionette = new TypeMission;
        $camionette->setName('Capturation');
            $manager->persist($camionette);

        $eglise = new TypeMission;
        $eglise->setName('Protection');
            $manager->persist($eglise);

        $acier = new TypeMission;
        $acier->setName('Sécurisation');
            $manager->persist($acier);

        $vaisseau = new TypeMission;
        $vaisseau->setName('Sabotage');
            $manager->persist($vaisseau);

        $peniche = new TypeMission;
        $peniche->setName('Soutien');
            $manager->persist($peniche);

        $egout = new TypeMission;
        $egout->setName('Transport');
            $manager->persist($egout);

        //Statut -----------------------------------------------

        $tunnel = new Statut;
        $tunnel->setName('En préparation');
            $manager->persist($tunnel);

        $institut = new Statut;
        $institut->setName('En cours');
            $manager->persist($institut);

        $alcatraz = new Statut;
        $alcatraz->setName('Terminé');
            $manager->persist($alcatraz);

        $wagon = new Statut;
        $wagon->setName('Echec');
            $manager->persist($wagon);

        

        $manager->flush();
    }
}
