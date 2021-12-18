<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Matchs;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('date', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class,[
                'date_widget'=>'single_text'])
            ->add('nbjoueurs')
            ->add('type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Matchs::class,
        ]);
    }
}
