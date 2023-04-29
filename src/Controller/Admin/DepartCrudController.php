<?php

namespace App\Controller\Admin;

use App\Entity\Depart;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DepartCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Depart::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
