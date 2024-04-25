<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Images::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            // DateField::new('updatedAt'),
            TextField::new('nom')->setFormType(VichImageType::class)->onlyWhenCreating(),
            ImageField::new('nom', "nom")
                ->setUploadDir("public/images/products")
                ->setBasePath('images/products'),
        ];
    }
}