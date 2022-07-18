<?php

namespace App\Controller\Admin;

use App\Entity\Entretien;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EntretienCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Entretien::class;
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
