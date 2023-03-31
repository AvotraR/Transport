<?php

namespace App\Form;

use App\Entity\Prix;
use App\Entity\Depart;
use App\Entity\Categorie;
use App\Entity\Destination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prix')
            ->add('destination', EntityType::class,[
                'class'=>Destination::class,
                'choice_label'=>'ville'
            ])
            ->add('Categorie', EntityType::class,[
                'class'=>Categorie::class,
                'choice_label'=>'categorie'
            ])
            ->add('depart', EntityType::class,[
                'class'=>Depart::class,
                'choice_label'=>'ville'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prix::class,
        ]);
    }
}
