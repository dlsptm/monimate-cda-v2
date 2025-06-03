<?php

namespace App\Repository;

use App\Entity\AccountUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccountUser>
 */
class AccountUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountUser::class);
    }

    public function fetchPersonnalAccount(string $memberId): ?AccountUser
    {
        return $this->createQueryBuilder('au')
            ->join('au.account', 'ac')
            ->join('au.member', 'm')
            ->andWhere('ac.isShared = :is_shared')
            ->andWhere('m.id = :memberId')
            ->setParameter('is_shared', false)
            ->setParameter('memberId', $memberId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findBySlugAndMemberId(string $slug, string $memberId) : ?AccountUser
    {
        return $this->createQueryBuilder('au')
            ->join('au.account', 'ac')
            ->join('au.member', 'm')
            ->andWhere('ac.slug = :slug')
            ->andWhere('m.id = :memberId')
            ->setParameter('slug', $slug)
            ->setParameter('memberId', $memberId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    //    /**
    //     * @return AccountUser[] Returns an array of AccountUser objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AccountUser
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
