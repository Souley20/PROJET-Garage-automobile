<?php

namespace App\Controller\Admin;

use App\Form\ImageType;
use App\Entity\VoituresOccasions;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoituresOccasionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VoituresOccasions::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield CollectionField::new('voituresOcassionsImages', 'Images')
            ->setEntryType(ImageType::class);
        yield AssociationField::new('voituresOcassionsMarques', 'Selection marques');
        yield NumberField::new('prix', 'Prix');
        yield DateField::new('annee', 'Année');
        yield NumberField::new('kilometrage');
        yield TextField::new('carburant');
        yield TextField::new('boiteDeVitesse');
    }
}