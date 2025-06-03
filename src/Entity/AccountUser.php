<?php

namespace App\Entity;

use App\Entity\Traits\BlamableTrait;
use App\Entity\Traits\DateTimeImmutableTrait;
use App\Repository\AccountUserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: AccountUserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: '`account_user`')]
class AccountUser
{
    use BlamableTrait;
    use DateTimeImmutableTrait;

    #[ORM\ManyToOne(inversedBy: 'accountUsers')]
    private ?Account $account = null;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: Types::STRING)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?string $id = null;

    #[ORM\Column]
    private ?bool $isAdmin = null;

    #[ORM\ManyToOne(inversedBy: 'accountUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $member = null;

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMember(): ?User
    {
        return $this->member;
    }

    public function isAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setAccount(?Account $account): static
    {
        $this->account = $account;

        return $this;
    }

    public function setIsAdmin(bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function setMember(?User $member): static
    {
        $this->member = $member;

        return $this;
    }
}
