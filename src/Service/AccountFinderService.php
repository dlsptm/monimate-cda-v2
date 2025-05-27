<?php

namespace App\Service;

use App\Entity\Account;
use App\Repository\AccountUserRepository;
use RuntimeException;

readonly class AccountFinderService
{

    public function __construct(
        private AccountUserRepository $accountUserRepository,
    )
    {
    }

    public function findAccount(string $slug, string $memberId): Account
    {
        $accountUser = $this->accountUserRepository->findBySlugAndMemberId($slug, $memberId);

        if (!$accountUser || !$accountUser->getAccount()) {
            throw new RuntimeException(sprintf('Le compte "%s" est introuvable ou inaccessible.', $slug));
        }

        return $accountUser->getAccount();
    }
}
