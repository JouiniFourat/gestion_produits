<?php

namespace App\Controller\Admin;

use App\Entity\Inventory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class InventoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inventory::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('point_vente'),
            AssociationField::new('visite'),
            AssociationField::new('produit'),
            DateField::new('date_visite'),
            NumberField::new('total'),
            NumberField::new('sold'),
            NumberField::new('inStock'),
        ];
    }
    
    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
        ->add('point_vente')
        ->add('visite')
        ->add('date_visite');
    }
    
    
}
