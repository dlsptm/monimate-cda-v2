<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\AccountFinderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/', name: 'app_')]
final class HomeController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/', name: 'index')]
    public function index(
        AccountFinderService $accountFinderService,
    ): Response {
        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user) {
            return $this->render('home/home.html.twig', []);
        }

        $account = $accountFinderService->findAccountByUser((string) $user->getId());

        return $this->redirectToRoute('account_index', ['slug' => $account->getSlug()]);
    }
}
