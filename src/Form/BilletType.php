<?php

namespace App\Form;

use App\Entity\Billet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Destination;
use App\Entity\Categorie;
use App\Entity\Depart;

class BilletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Telephone')
            ->add('CIN')
            ->add('destination',EntityType::class,[
                'class'=>Destination::class,
                'choice_label'=>"ville"
            ])
            ->add('categorie',EntityType::class,[
                'class'=>Categorie::class,
                'choice_label'=>"categorie"
            ])
            ->add('depart',EntityType::class,[
                'class'=>Depart::class,
                'choice_label'=>"ville"
            ])
            ->add('DateReservation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Billet::class,
        ]);
    }
}
