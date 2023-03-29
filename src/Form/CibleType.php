<?php

namespace App\Form;

use App\Entity\Cible;
use App\Entity\Nationalite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CibleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => [
                'class' => 'form-control',
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
            ],
            'label' => 'Prénom', 
            'required' => true,
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
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
            ],  
            ])
        ->add('codeName', TextType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'label' => 'Nom de code', 
            'required' => true,
            'label_attr' => [
                'class' => 'form-label mt-4'
            ]
            ])
        ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Créer une cible'
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
            ]
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
            'data_class' => Cible::class,
            'labelButton' => 'Valider',
        ]);
    }
}
