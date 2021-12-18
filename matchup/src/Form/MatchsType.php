<?php

namespace App\Form;

use App\Entity\Matchs;
use App\Entity\Tournoi;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\Int_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class MatchsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    ''=>'',
                    'Football' => 'Football',
                    'Basketball' => 'Basketball',
                    'Volleyball' => 'Volleyball',
                    'Handball' => 'Handball',
                    'Tennis' => 'Tennis',

                ],
                'preferred_choices' => ['muppets', 'arr'],
            ])
            ->add('date',DateTimeType::class ,['date_widget'=>'single_text'])
            ->add('nbjoueurs')
            ->add('id_tournoi', EntityType::class, [
                'class'=> Tournoi::class,
                'choice_label'=>'nomTournoi',
                'multiple'=>false,

            ])


        ;

    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Matchs::class,
        ]);
    }
}
