<?php

namespace App\Controller\Admin;

use App\Entity\Equipement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EquipementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equipement::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'identifier')->onlyOnIndex(),
            TextField::new('name', 'Nom'),
            AssociationField::new('ligne','Ligne de production')
        ];
    }

}
