<?php

namespace App\Controller\Admin;

use App\Entity\Jours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class JoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Jours::class;
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