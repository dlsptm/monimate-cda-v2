<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\AccountUserRepository;
use App\Repository\GoalRepository;
use App\Repository\IncomeRepository;
use App\Repository\SavingRepository;
use App\Repository\TransactionRepository;
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
        TransactionRepository $transactionRepository,
        IncomeRepository $incomeRepository,
        SavingRepository $savingRepository,
        GoalRepository $goalRepository,
        string $slug,
    ): Response {
        /** @var User|null $currentUser */
        $currentUser = $this->getUser();

        if (!$currentUser) {
            return $this->redirectToRoute('app_login');
        }

        $accountUser = $accountUserRepository->findBySlugAndMemberId($slug, (string) $currentUser->getId());

        if (!$accountUser) {
            return $this->redirectToRoute('account_find');
        }

        $totalByCategory = $transactionRepository->fetchAllByCategory(
            (string) $accountUser->getAccount()?->getId(),
            (string) $currentUser->getId()
        );

        $incomes = $incomeRepository->fetchIncomeByMonth(
            (string) $currentUser->getId(),
            date('m'),
            date('Y')
        );

        $savings = $savingRepository->findBy(['createdBy' => (string) $currentUser->getId()]);
        $goals = $goalRepository->findBy(['createdBy' => (string) $currentUser->getId()]);

        return $this->render('account/index.html.twig', [
            'accountUser' => $accountUser,
            'transactions' => $accountUser->getAccount()?->getTransactions(),
            'totalByCategory' => $totalByCategory,
            'incomes' => $incomes,
            'savings' => $savings,
            'goals' => $goals,
        ]);
    }


    #[Route('/', name: 'find')]
    public function find(AccountUserRepository $accountUserRepository): Response
    {
        /** @var User|null $currentUser */
        $currentUser = $this->getUser();

        if (!$currentUser) {
            return $this->redirectToRoute('app_login');
        }

        $accountUsers = $accountUserRepository->findBy(['member' => $this->getUser()->getId()]);

        return $this->render('account/find.html.twig', [
            'accountUsers' => $accountUsers,
        ]);
    }
}
