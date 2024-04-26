<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom'],
                'required' => true,
            ])
            ->add('prenom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prénom'],
                'required' => true,
            ])
            ->add('commentaire', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Votre commentaire'],
                'required' => true,
            ])
            ->add('valide', CheckboxType::class, [
                'attr' => ['class' => 'form-check'],
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}