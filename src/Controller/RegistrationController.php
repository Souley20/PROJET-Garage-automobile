<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Security\UsersAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UsersPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UsersAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(
        Request $request,
        UsersPasswordHasherInterface $usersPasswordHasher,
        UsersAuthenticatorInterface $usersAuthenticator,
        UsersAuthenticator $authenticator,
        EntityManagerInterface $entityManager
    ): Response {
        $users = new Users();
        $form = $this->createForm(RegistrationFormType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $users->setPassword(
                $usersPasswordHasher->hashPassword(
                    $users,
                    $form->get('plainPassword')->getData()
                ) // Removed extra semicolon here.
            );

            $users->setRoles(
                $form->get('roles')->getData()
            );

            $entityManager->persist($users);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $usersAuthenticator->authenticateUsers(
                $users,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}