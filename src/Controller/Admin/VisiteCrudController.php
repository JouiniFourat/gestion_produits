<?php

namespace App\Controller\Admin;

use App\Entity\Visite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VisiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Visite::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('description'),
            DateField::new('date_visite'),
            AssociationField::new('point_vente'),
        ];
    }
    
}
