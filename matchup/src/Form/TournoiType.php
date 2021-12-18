<?php

namespace App\Form;

use App\Entity\Tournoi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TournoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomTournoi')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Football' => 'Football',
                    'Basketball' => 'Basketball',
                    'Volleyball' => 'Volleyball',
                    'Handball' => 'Handball',
                    'Tennis' => 'Tennis',

                ],
                'preferred_choices' => ['muppets', 'arr'],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tournoi::class,
        ]);
    }
}
