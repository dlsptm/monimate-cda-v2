<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Entity\User;
use App\Form\TransactionForm;
use App\Repository\TransactionRepository;
use App\Service\AccountFinderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('account/{slug}/transaction', name: 'transaction_')]
final class TransactionController extends AbstractController
{
    #[Route('/{category}/category', name: 'category', methods: ['GET'])]
    public function byCategory(
        TransactionRepository $transactionRepository,
        AccountFinderService $accountFinderService,
        string $category,
        string $slug,
    ): Response {
        /** @var User $user */
        $user = $this->getUser();

        $account = $accountFinderService->findAccountBySlug($slug, (string) $user->getId());

        $transactions = $transactionRepository->findByCategory(
            (string) $account->getId(),
            (string) $user->getId(),
            $category,
        );

        return $this->render('transaction/category.html.twig', [
            'transactions' => $transactions,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Transaction $transaction, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $transaction->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($transaction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('transaction_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transaction $transaction, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TransactionForm::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('transaction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
        ]);
    }

    #[Route(name: 'index', methods: ['GET'])]
    public function index(
        TransactionRepository $transactionRepository,
        AccountFinderService $accountFinderService,
        string $slug,
    ): Response {
        /** @var User $user */
        $user = $this->getUser();
        $account = $accountFinderService->findAccountBySlug($slug, (string) $user->getId());

        return $this->render('transaction/index.html.twig', [
            'transactions' => $transactionRepository->findAll(),
            'account' => $account,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        AccountFinderService $accountFinderService,
        string $slug,
    ): Response {
        $transaction = new Transaction();
        $form = $this->createForm(TransactionForm::class, $transaction);
        $form->handleRequest($request);

        /** @var User $user */
        $user = $this->getUser();

        $account = $accountFinderService->findAccountBySlug($slug, (string) $user->getId());

        if ($form->isSubmitted() && $form->isValid()) {
            $transaction->setAccount($account);
            $entityManager->persist($transaction);
            $entityManager->flush();

            return $this->redirectToRoute('transaction_index', ['slug' => $slug], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transaction/new.html.twig', [
            'account' => $account,
            'transaction' => $transaction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Transaction $transaction): Response
    {
        return $this->render('transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }
}
