<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Photograph;
use App\Entity\User;
use App\Form\RegistrationFormClientType;
use App\Form\RegistrationFormPhotographType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function chooseForm()
    {
        return $this->render('registration/chooseClass.html.twig');
    }

    #[Route('/register/{class}', name: 'app_register_class')]
    public function register(Request                     $request,
                             UserPasswordHasherInterface $userPasswordHasher,
                             EntityManagerInterface      $entityManager,
                             string                      $class): Response
    {
        if ($class == "Photographe") {
            $user = new Photograph();
            $user->setProfilPicture('fccf706d26042ccf2cc9c110760d8ba0.png');
            $form = $this->createForm(RegistrationFormPhotographType::class, $user);
        } else if ($class == "Client") {
            $user = new Client();
            $form = $this->createForm(RegistrationFormClientType::class, $user);
        } else {
            return $this->redirectToRoute('app_home_index');
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')
                         ->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home_index');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'chosenClass'      => $class
        ]);
    }
}
