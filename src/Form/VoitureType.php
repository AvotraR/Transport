<?php

namespace App\Form;

use App\Entity\Voiture;
use App\Entity\Categorie;
use App\Entity\Destination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Numero')
            ->add('Destination',EntityType::class,['class'=>Destination::class,'choice_label'=>"ville"])
            ->add('categorie',EntityType::class,['class'=>Categorie::class,'choice_label'=>"categorie"])
            ->add('place', CollectionType::class, [
                    'entry_type' =>CheckboxType::class, // Le type de chaque élément de la collection
                    'allow_add' => true,
                    'empty_data'=>false,
                    'required'=>false,
                ]) 
            ->add('NbPlace')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
