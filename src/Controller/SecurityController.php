<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\AccountUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/deactivate', name: 'app_deactivate')]
    public function deactivate(
        EntityManagerInterface $entityManager,
    ): Response {
        if (!$this->getUser()) {
            $this->redirectToRoute('app_login');
        }

        /** @var User $user */
        $user = $this->getUser();
        $user->setIsActive(false);

        $entityManager->flush();

        return $this->redirectToRoute('app_logout');
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, AccountUserRepository $accountUserRepository): Response
    {
        if ($this->getUser()) {
            /**@var User $user*/
            $user =$this->getUser();
            $accountUser = $accountUserRepository->fetchPersonnalAccount($user->getId());
            return $this->redirectToRoute('account_index', ['slug' => $accountUser->getAccount()->getSlug()]);
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        if (!$this->getUser()) {
            $this->redirectToRoute('app_login');
        }

        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
