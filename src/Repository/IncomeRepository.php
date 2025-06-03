<?php

namespace App\Repository;

use App\Entity\Income;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Income>
 */
class IncomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Income::class);
    }

    public function fetchIncomeByMonth(string $createdBy, string $month, string $year): array
    {
        $startDate = new \DateTime(\sprintf('%d-%02d-01', $year, $month));
        $endDate = (clone $startDate)->modify('first day of next month');

        $qb = $this->createQueryBuilder('i')
            ->andWhere('i.createdBy = :createdBy')
            ->andWhere('i.createdAt >= :startDate')
            ->andWhere('i.createdAt < :endDate')
            ->setParameter('createdBy', $createdBy)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->orderBy('i.createdAt', 'DESC');

        return $qb->getQuery()->getResult();
    }
}
