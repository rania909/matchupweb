<?php

namespace App\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Produit;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nomProduit')
            ->add('prix')
            ->add('quantiteTotal')
            ->add('quantiteRestant')
            ->add('description')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
            ])
            ->add('id_categorie', EntityType::class, [
                'class'=> Categorie::class,
                'choice_label'=>'nomCategorie',
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
