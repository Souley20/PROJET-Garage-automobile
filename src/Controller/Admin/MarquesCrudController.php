<?php

namespace App\Controller\Admin;

use App\Entity\Marques;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MarquesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marques::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomMarques', 'Marques'),
            TextField::new('modeles', 'Modèles'),
        ];
    }
}