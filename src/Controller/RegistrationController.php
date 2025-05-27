<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\AccountUser;
use App\Entity\User;
use App\Form\RegistrationForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()) {
            $this->redirectToRoute('app_home');
        }

        $user = new User();
        $form = $this->createForm(RegistrationForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $account = new Account();
            $account->setTitle("Compte de {$user->getUsername()}");
            $account->setIsShared(false);
            $account->setCreatedBy($user);
            $account->setUpdatedBy($user);

            $accountUser = new AccountUser();
            $accountUser->setMember($user);
            $accountUser->setAccount($account);
            $accountUser->setIsAdmin(true);
            $accountUser->setCreatedBy($user);
            $accountUser->setUpdatedBy($user);

            $entityManager->persist($user);
            $entityManager->persist($account);
            $entityManager->persist($accountUser);

            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
