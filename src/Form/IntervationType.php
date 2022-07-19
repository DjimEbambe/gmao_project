<?php

namespace App\Form;

use App\Entity\Intervation;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use SearchableEntityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class IntervationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required'=>true,
                'constraints'=>new Length([
                    'min'=>3,
                    'max'=>30
                ]),
            ])
            //->add('createdAt')
            ->add('equipement')
            ->add('etat', ChoiceType::class, [
                'choices'  => [
                    'Encours' => "Encours",
                    'Fini' => "Fini",
                    'Ratée' => "Ratée",
                    'En attente' => "Ratée",
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Entretien' => "Entretien",
                    'Panne' => "Panne",
                ],
            ])
            ->add('time', TimeType::class, [
                'placeholder' => [
                    'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Seconde',
                ],
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('intervenant', EntityType::class, [
                'class' => User::class,
                'multiple'=>true,
                'query_builder' => function (EntityRepository $er){
                   return $er->createQueryBuilder('t')
                        ->orderBy('t.roles', 'ASC');
                },
                'attr'=>[
                    'class'=>'select-user'
                ],
                'expanded'=> false,
                'by_reference'=>false
            ])
            ->add('description', TextareaType::class)
            ->add('risque', ChoiceType::class)
            ->add('epi', ChoiceType::class)


        ;


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervation::class,
        ]);
    }
}
