<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\AccountUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/account', name: 'account_')]
final class AccountController extends AbstractController
{
    #[Route('/{slug}', name: 'index')]
    public function index(
        AccountUserRepository $accountUserRepository,
        string $slug,
    ): Response {
        /** @var User $currentUser */
        $currentUser = $this->getUser();

        $accountUser = $accountUserRepository->findBySlugAndMemberId($slug, $currentUser->getId());

        if (!$accountUser) {
            throw $this->createNotFoundException('Cette page n\'existe pas.');
        }

        return $this->render('account/index.html.twig', [
            'accountUser' => $accountUser,
            'transactions' => $accountUser->getAccount()->getTransactions(),
        ]);
    }
}
