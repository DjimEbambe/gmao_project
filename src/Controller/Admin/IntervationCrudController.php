<?php

namespace App\Controller\Admin;

use App\Entity\Intervation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class IntervationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Intervation::class;
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
