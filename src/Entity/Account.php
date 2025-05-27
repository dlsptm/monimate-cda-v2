<?php

namespace App\Entity;

use App\Entity\Traits\BlamableTrait;
use App\Entity\Traits\DateTimeImmutableTrait;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
#[ORM\Table(name: '`account`')]
#[ORM\HasLifecycleCallbacks]
class Account
{
    use BlamableTrait;
    use DateTimeImmutableTrait;

    /**
     * @var Collection<int, AccountUser>
     */
    #[ORM\OneToMany(
        targetEntity: AccountUser::class,
        mappedBy: 'account',
        cascade: ['persist', 'remove'],
        orphanRemoval: true
    )]
    private Collection $accountUsers;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: Types::STRING)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?string $id = null;

    #[ORM\Column]
    private bool $isAdmin = true;

    #[ORM\Column]
    private bool $isShared = false;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var Collection<int, Transaction>
     */
    #[ORM\OneToMany(
        targetEntity: Transaction::class,
        mappedBy: 'account',
        cascade: ['persist', 'remove'],
        orphanRemoval: true
    )]
    private Collection $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->accountUsers = new ArrayCollection();
    }

    public function addAccountUser(AccountUser $accountUser): static
    {
        if (!$this->accountUsers->contains($accountUser)) {
            $this->accountUsers->add($accountUser);
            $accountUser->setAccount($this);
        }

        return $this;
    }

    public function addTransaction(Transaction $transaction): static
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
            $transaction->setAccount($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, AccountUser>
     */
    public function getAccountUsers(): Collection
    {
        return $this->accountUsers;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function isShared(): bool
    {
        return $this->isShared;
    }

    public function removeAccountUser(AccountUser $accountUser): static
    {
        if ($this->accountUsers->removeElement($accountUser) && $accountUser->getAccount() === $this) {
            // set the owning side to null (unless already changed)
            $accountUser->setAccount(null);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): static
    {
        if ($this->transactions->removeElement($transaction) && $transaction->getAccount() === $this) {
            // set the owning side to null (unless already changed)
            $transaction->setAccount(null);

        }

        return $this;
    }

    public function setIsAdmin(bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function setIsShared(bool $isShared): static
    {
        $this->isShared = $isShared;

        return $this;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function slugger(): void
    {
        $oldSlug = $this->getSlug();
        $slugger = new AsciiSlugger();
        $slug = $slugger->slug($this->getTitle())->lower()->toString();
        if ($oldSlug && $oldSlug == $slug) {
            return;
        }
        $this->setSlug($slug);
    }
}
