<?php

namespace App\Form;

use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomTerrain',ChoiceType::class, [
                'choices' => [
                    'Camp' => 'Camp',
                    'x' => 'x',
                    'b' => 'b',
                    'new' => 'new',
                ],
                'preferred_choices' => ['muppets', 'arr'],
            ])
            ->add('typeMat',ChoiceType::class, [
                'choices' => [
                    'ballons' => 'ballons',
                    'Kit dentrainement' => 'Kit dentrainement',
                    'Cerceau plat' => 'Cerceau plat',

                ],
                'preferred_choices' => ['muppets', 'arr'],
            ])
            ->add('quantMat')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
