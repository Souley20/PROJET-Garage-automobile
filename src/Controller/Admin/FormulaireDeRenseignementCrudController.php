<?php

namespace App\Controller\Admin;

use App\Entity\FormulaireDeRenseignement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;


class FormulaireDeRenseignementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FormulaireDeRenseignement::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex(),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('telephone'),
            EmailField::new('email'),
            TextField::new('sujet'),
            TextareaField::new('message'),
            BooleanField::new('valide'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW)
            ->disable(Action::EDIT);
    }
}