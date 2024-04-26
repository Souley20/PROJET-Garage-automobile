<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class ContactType extends AbstractType
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
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse mail'],
                'required' => true,
            ])
            ->add('telephone', TelType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Téléphone'],
                'required' => false,
            ])
            ->add('sujet', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Sujet'],
                'required' => true,
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Votre message ici'],
                'required' => true,
            ])
            ->add('envoyer', SubmitType::class, [
                'attr' => ['class' => 'button'],
            ]);
    }
}