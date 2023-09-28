<?php

namespace App\Form;

use App\Entity\Agent;
use App\Entity\Nationalite;
use App\Entity\Specialite;
use App\Repository\SpecialiteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlength' => '2',
                'maxlength' => '50'
            ],
            'label' => 'Nom',
            'required' => true,
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
        ])
        ->add('firstName', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlength' => '2',
                'maxlength' => '50'
            ],
            'label' => 'Prénom',
            'required' => true,
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            ])
        ->add('dateOfBirth', DateType::class, [
            'widget' => 'single_text',
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Date de naissance',
            'required' => true,
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
            ])
        ->add('identificationCode', NumberType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlength' => '2',
            ],
            'label' => 'Code d\'idendification',
            'required' => true,
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
            ])
            ->add('nationalite', EntityType::class, [
                'class' => Nationalite::class,
                'placeholder' => 'selectionner une nationalité',
                'choice_label' => 'name',
                'label' => 'Nationalité',
                'attr' => [
                    'class' => 'select2'
                ],
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('specialite', EntityType::class, [
                'class' => Specialite::class,
                'query_builder' => function (SpecialiteRepository $r) {
                    return $r->createQueryBuilder('s')
                        ->orderBy('s.name', 'ASC');
                },
                'label' => 'Spécialités',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'attr' => [
                    'class' => 'select2'
                ],
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4',
            ],
            'label' => $options['labelButton'],

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agent::class,
            'labelButton' => 'Valider',
        ]);
    }
}
