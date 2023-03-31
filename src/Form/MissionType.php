<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Cible;
use App\Entity\Contact;
use App\Entity\Mission;
use App\Entity\Pays;
use App\Entity\Planque;
use App\Entity\Specialite;
use App\Entity\Statut;
use App\Entity\TypeMission;
use App\Repository\AgentRepository;
use App\Repository\CibleRepository;
use App\Repository\ContactRepository;
use App\Repository\PaysRepository;
use App\Repository\PlanqueRepository;
use App\Repository\SpecialiteRepository;
use App\Repository\StatutRepository;
use App\Repository\TypeMissionRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class MissionType extends AbstractType
{
    private $agentRepository;
    private $contactRepository;
    private $planqueRepository;

    public function __construct(AgentRepository $agentRepository, ContactRepository $contactRepository, PlanqueRepository $planqueRepository)
    {
        $this->agentRepository = $agentRepository;
        $this->contactRepository = $contactRepository;
        $this->planqueRepository = $planqueRepository;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('title', TextType::class, [
                    'attr' => [
                        'class' => 'form-control',
                        'minlength' => '2',
                        'maxlength' => '255'
                    ],
                    'label' => 'Titre de la mission',
                    'required'=> true,
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ]
                ])
            ->add('codeName', TextType::class, [
                    'attr' => [
                        'class' => 'form-control',
                        'minlength' => '2',
                        'maxlength' => '255'
                    ],
                    'label' => 'Nom de code',
                    'required'=> true,
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ]
                ])
            ->add('description', TextareaType::class, [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'required'=> true,
                    'label' => 'Description',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ]
                ])
            ->add('dateStart', DateType::class, [
                    'widget' => 'single_text',
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Date de début',
                    'required'=> true,
                    'by_reference' => true,
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ]
                ])
            ->add('dateEnd', DateType::class, [
                    'widget' => 'single_text',
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Date de fin',
                    'required'=> true,
                    'by_reference' => true,
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ]
                    ])
            ->add('pays', EntityType::class, [
                    'class' => Pays::class,
                    'query_builder' => function (PaysRepository $r) {
                        return $r->createQueryBuilder('p')
                            ->orderBy('p.name', 'ASC');
                    },
                    'attr' => [
                        'class' => 'select2 mt-4'
                    ],
                    'label' => 'Pays',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'choice_label' => 'name',
                    'placeholder' => 'selectionner un pays',
                    'required'=> true,
                ])
            ->add('cible', EntityType::class, [
                    'class' => Cible::class,
                    'query_builder' => function (CibleRepository $r) {
                        return $r->createQueryBuilder('c')
                            ->orderBy('c.name', 'ASC');
                    },
                    'attr' => [
                        'class' => 'select2 select-choice mt-4'
                    ],
                    'label' => 'Les cibles',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'choice_label' => 'name',
                    'placeholder' => 'selectionner une cible',
                    'multiple' => true,
                    'required'=> true,
                ])
            ->add('typeMission', EntityType::class, [
                    'class' => TypeMission::class,
                    'query_builder' => function (TypeMissionRepository $r) {
                        return $r->createQueryBuilder('m')
                            ->orderBy('m.name', 'ASC');
                    },
                    'attr' => [
                        'class' => 'select2 select-choice mt-4'
                    ],
                    'label' => 'Type de mission',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'choice_label' => 'name',
                    'placeholder' => 'selectionner une cible',
                    'required'=> true,
                ])
            ->add('specialite', EntityType::class, [
                    'class' => Specialite::class,
                    'query_builder' => function (SpecialiteRepository $r) {
                        return $r->createQueryBuilder('s')
                            ->orderBy('s.name', 'ASC');
                    },
                    'attr' => [
                        'class' => 'select2 select-choice mt-4'
                    ],
                    'label' => 'Spécialité requise',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'choice_label' => 'name',
                    'placeholder' => 'selectionner une spécialité',
                    'required'=> true,
                ])
            ->add('agent', EntityType::class, [
                    'class' => Agent::class,
                    'choice_label' => 'name',
                    'placeholder' => 'choisissez votre agent',
                    'query_builder' => function (AgentRepository $r) {
                        return $r->createQueryBuilder('a')
                          ->orderBy('a.name', 'ASC');
                    },
                    'attr' => [
                        'class' => 'select2 mt-4'
                    ],
                    'label' => 'Les agents',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'choice_label' => 'name',

                    'multiple' => true,
                    'required'=> true,
                ])
            ->add('contact', EntityType::class, [
                    'class' => Contact::class,
                    'query_builder' => function (ContactRepository $r) {
                        return $r->createQueryBuilder('c')
                            ->orderBy('c.name', 'ASC');
                    },
                    'attr' => [
                       'class' => 'select2 select-choice mt-4'
                    ],
                    'label' => 'Les contacts',
                    'label_attr' => [
                       'class' => 'form-label mt-4'
                    ],
                    'choice_label' => 'name',
                    'placeholder' => 'selectionner un contact',
                    'multiple' => true,
                    'required'=> true,
                ])
            ->add('planque', EntityType::class, [
                    'class' => Planque::class,
                    'query_builder' => function (PlanqueRepository $r) {
                        return $r->createQueryBuilder('p')
                            ->orderBy('p.type', 'ASC');
                    },
                    'attr' => [
                        'class' => 'select2 select-choice mt-4'
                    ],
                    'label' => 'La planque',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'choice_label' => 'type',
                    'placeholder' => 'selectionner une planque',
                    'required'=> false
                ])
            ->add('statut', EntityType::class, [
                    'class' => Statut::class,
                    'query_builder' => function (StatutRepository $r) {
                        return $r->createQueryBuilder('s')
                            ->orderBy('s.name', 'ASC');
                    },
                    'attr' => [
                        'class' => 'select2 select-choice mt-4'
                    ],
                    'label' => 'statut de la mission',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'choice_label' => 'name',
                    'placeholder' => 'selectionner un statut',
                    'required'=> true,
                ])
            ->add('submit', SubmitType::class, [
                    'attr' => [
                        'class' => 'btn btn-primary mt-5',
                    ],
                    'label' => $options['labelButton'],
                ]);



        $builder->get('pays')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $dataContact = ($event->getForm()->getParent()->get('pays')->getData());
            $dataPlanque = ($event->getForm()->getParent()->get('pays')->getData());

            //function qui permet de mettre à jour les champs Contact et Planque en function de selection du champs Pays
            $this->addContactPlanque($form->getParent(), $dataContact, $dataPlanque);
        });

        $builder->get('specialite')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();

            $dataspecialite = ($event->getForm()->getParent()->get('specialite')->getData());
            $dataCible = ($event->getForm()->getParent()->get('cible')->getData());

            //function pour verifier si le champs cible a une valeur
            $listeCible = $this->listeCible($dataCible);

            //function qui permet de mettre à jour le champs Agent en function de selection du champs cible ou spécialité requise
            $this->addAgentRequis($form->getParent(), $dataspecialite, $listeCible);
        });
    }


    /**
     * Cette function permet de verifier si une valeur dans le champs Cible existe
     * si elle n'esite pas alors elle renvoi 0. sinon elle renvoi la valeur selectionner
     *
     * @param [type] $dataCible
     * @return void
     */
    private function listeCible($dataCible)
    {
        if ($dataCible->isEmpty()) {
            $liste = [0];
            return $liste;
        } else {
            foreach ($dataCible->toArray() as $dept) {
                $tableau []= $dept->getNationalite();
                $liste = $tableau;
                return $liste;
            }
        }
    }
    /**
     * Cette fonction permet de remplacer les champs Contact et Planque selon
     * le pays sélectionné
     *
     * @param [type] $form
     * @param [type] $dataContact
     * @param [type] $dataPlanque
     * @return void
     */
    private function addContactPlanque($form, $dataContact, $dataPlanque)
    {
        $listePlanque = $this->planqueRepository->createQueryBuilder('p')
            ->where('p.pays IN (:pays)')
            ->setParameter('pays', $dataPlanque)
            ->getQuery()
            ->getResult();

        $listeContact = $this->contactRepository->createQueryBuilder('c')
            ->where('c.nationalite NOT IN (:nationalite)')
            ->setParameter('nationalite', $dataContact)
            ->getQuery()
            ->getResult();


        $form->add('contact', EntityType::class, [
            'class' => Contact::class,
            'query_builder' => function (ContactRepository $r) {
                return $r->createQueryBuilder('c')
                    ->orderBy('c.name', 'ASC');
            },
            'choices' => $listeContact ? $listeContact : [],
            'attr' => [
                'class' => 'select2  mt-4'
            ],
            'label' => 'Les contacts',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'choice_label' => 'name',
            'multiple' => true,
        ]);

        $form->add('planque', EntityType::class, [
            'class' => Planque::class,
            'query_builder' => function (PlanqueRepository $r) {
                return $r->createQueryBuilder('p')
                    ->orderBy('p.type', 'ASC');
            },
            'choices' => $listePlanque ? $listePlanque : [],
            'attr' => [
                'class' => 'select2 select-choice mt-4'
            ],
            'label' => 'La planque',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'choice_label' => 'type',
            'placeholder' => 'selectionner une planque',
            'required' => false
        ]);
    }


    /**
     * cette fonction permet de remplacer le champ Agent en appliquant
     * des contraites de choix selon les paramétres sélectionner sur les champs
     * "cible" et "spécialité"
     *
     * @param [type] $form
     * @param [type] $dataspecialite
     * @param [type] $liste
     * @return void
     */
    private function addAgentRequis($form, $dataspecialite, $liste)
    {
        $listeAgentrequis = $this->agentRepository->createQueryBuilder('a')
            ->leftJoin('a.specialite', 's')
            ->where('s.id IN (:id)')
            ->setParameter('id', $dataspecialite ? $dataspecialite : [0])
            ->getQuery()
            ->getResult();

        $listeAgentCible = $this->agentRepository->createQueryBuilder('a')
            ->leftJoin('a.nationalite', 'n')
            ->where('n.id NOT IN (:id)')
            ->setParameter('id', $liste)
            ->getQuery()
            ->getResult();


        $form->add('agent', EntityType::class, [
            'class' => Agent::class,
            'choice_label' => 'name',
            'placeholder' => 'choisissez votre agent',
            'choices' => $listeAgentCible ? $listeAgentCible : [],
            'query_builder' => function (AgentRepository $r) {
                return $r->createQueryBuilder('a')
                  ->orderBy('a.name', 'ASC');
            },
            'attr' => [
                'class' => 'select2 mt4'
            ],
            'label' => 'Les agents : sélectionnez au moins 1 agent avec la sépcialité requise en haut de la liste',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'choice_label' => 'name',
            'multiple' => true,
            'preferred_choices' => $listeAgentrequis,
            'constraints' => [
              new Assert\Callback([
                  // Ici $value prend la valeur du champs que l'on est en train de valider,
                  'callback' => static function ($value, ExecutionContextInterface $context) use ($listeAgentrequis) {
                      //dd($listeAgentrequis);
                      //transforme valeur du champs Agent en tabeau pour comparer
                      $fiedAgent = $value->toArray();
                      //compare resultat du champs Agent avec specialité requise, le resultat doit être superieur a 0
                      $result = count(array_uintersect($fiedAgent, $listeAgentrequis, function ($fiedAgent, $listeAgentrequis) {
                          return strcmp(spl_object_hash($fiedAgent), spl_object_hash($listeAgentrequis));
                      })) > 0;
                      //si resultat superieur a 0, on peut continuer, sinon erreur + message
                      if ($result == true) {
                          return;
                      } else {
                          $context
                              ->buildViolation("Vous devez choisir au moins 1 agent avec la spécialité requise")
                              ->atPath('[agent]')
                              ->addViolation();
                      }
                  },
              ]),
          ]
          ]);
    }




    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
            'labelButton' => 'Valider',
        ]);
    }
}
