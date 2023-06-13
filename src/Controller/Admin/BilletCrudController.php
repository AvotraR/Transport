<?php

namespace App\Controller\Admin;

use App\Entity\Billet;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BilletCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Billet::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('destination'),
            AssociationField::new('depart'),
            AssociationField::new('categorie'),
            AssociationField::new('User'),
            TextField::new('place'),
            DateField::new('DateReservation'),
            AssociationField::new('voiture'),
        ];
    }
        
}
