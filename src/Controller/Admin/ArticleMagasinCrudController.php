<?php

namespace App\Controller\Admin;

use App\Entity\ArticleMagasin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleMagasinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArticleMagasin::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            DateField::new('createdAt','Date ajout')->onlyOnIndex(),
            AssociationField::new('fournisseur'),
            ChoiceField::new('emplacement', 'Emplacement')->setChoices([
                'Emplacement_1' => 'Emplacement_1',
                'Emplacement_2'=>'Emplacement_2',
                'Emplacement_3'=>'Emplacement_3',
                'Emplacement_4'=>'Emplacement_4',
            ]),
            TextEditorField::new('description'),
            TextField::new('reference','Référence')->onlyOnIndex(),
            IntegerField::new('quantity', 'Quantité'),
        ];
    }

}
