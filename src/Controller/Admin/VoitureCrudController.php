<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Numero'),
            AssociationField::new('categorie'),
            AssociationField::new('Destination'),
            NumberField::new('NbPlace'),
            BooleanField::new('isArrived'),
            CollectionField::new('Place')->setEntryType(CheckboxType::class)->allowDelete(false),
        ];
    }
}
