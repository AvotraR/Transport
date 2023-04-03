<?php

namespace App\Form;

use App\Entity\Billet;
use App\Entity\Depart;
use App\Entity\Categorie;
use App\Entity\Destination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
            ->add('DateReservation', DateType::class,
            [
                'label' => 'Date de depart',
                'widget' => 'single_text',
                'required' => false,
                'attr' => [
                    'class' => 'datetime',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
