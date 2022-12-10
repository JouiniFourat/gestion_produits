<?php

namespace App\Controller\Admin;

use App\Entity\PointVente;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PointVenteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PointVente::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('full_name'),
            TextField::new('adresse'),
            DateField::new('date_creation'),
            AssociationField::new('client'),
        ];
    }
}
