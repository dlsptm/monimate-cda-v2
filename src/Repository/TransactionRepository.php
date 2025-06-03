<?php

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Transaction>
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function fetchAllByCategory(string $accountId, string $createdBy): array
    {
        return $this->createQueryBuilder('t')
            ->select('c.title AS category', 'SUM(t.amount) AS total')
            ->join('t.category', 'c')
            ->andWhere('t.account = :accountId')
            ->andWhere('t.createdBy = :createdBy')
            ->setParameter('accountId', $accountId)
            ->setParameter('createdBy', $createdBy)
            ->groupBy('c.title')
            ->getQuery()
            ->getResult();
    }

    public function findByCategory(string $accountId, string $createdBy, string $category): array
    {
        return $this->createQueryBuilder('t')
            ->join('t.category', 'c')
            ->andWhere('t.account = :accountId')
            ->andWhere('t.createdBy = :createdBy')
            ->andWhere('c.title = :category')
            ->setParameter('accountId', $accountId)
            ->setParameter('createdBy', $createdBy)
            ->setParameter('category', $category)
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
