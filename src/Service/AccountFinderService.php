<?php

namespace App\Service;

use App\Entity\Account;
use App\Repository\AccountUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountFinderService extends AbstractController
{
    public function __construct(
        private readonly AccountUserRepository $accountUserRepository,
    ) {
    }

    public function findAccountBySlug(string $slug, string $memberId): ?Account
    {
        $accountUser = $this->accountUserRepository->findBySlugAndMemberId($slug, $memberId);

        if (!$accountUser || !$accountUser->getAccount()) {
            $this->redirectToRoute('account_find');
        }

        return $accountUser?->getAccount();
    }

    public function findAccountByUser(string $memberId): ?Account
    {
        $accountUser = $this->accountUserRepository->fetchPersonnalAccount($memberId);

        if (!$accountUser || !$accountUser->getAccount()) {
            $this->redirectToRoute('account_find');
        }

        return $accountUser?->getAccount();
    }
}
