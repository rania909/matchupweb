<?php

namespace App\Form;

use App\Entity\Terrain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;

class TerrainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomTerrain')
            ->add('emplacement',ChoiceType::class, [
                'choices' => [
                    'tunis' => 'tunis',
                    'sousse' => 'sousse',
                    'beja' => 'beja',
                    'Manouba' => 'Manouba',
                ],
                'preferred_choices' => ['muppets', 'arr'],
            ])

            ->add('type',ChoiceType::class, [
                'choices' => [
                    'Football' => 'Football',
                    'Tennis' => 'Tennis',
                    'Handball' => 'Handball',
                    'Basketball' => 'Basketball',

                ],
                'preferred_choices' => ['muppets', 'arr'],
            ])
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Disponible' => 'Disponible',
                    'Non disponible' => 'Non disponible',

                ],
                'preferred_choices' => ['muppets', 'arr'],
            ])

            ->add("captchaCode",CaptchaType::class,[
                'captchaConfig' => 'ExampleCaptchaUserRegistration',
                'constraints' => [
                    new ValidCaptcha([
                        'message' => 'Invalide Captcha, please try again'
                    ])
                ]

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Terrain::class,
        ]);
    }
}
