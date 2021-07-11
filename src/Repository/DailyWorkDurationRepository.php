<?php

namespace App\Repository;

use App\Entity\DailyWorkDuration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DailyWorkDuration|null find($id, $lockMode = null, $lockVersion = null)
 * @method DailyWorkDuration|null findOneBy(array $criteria, array $orderBy = null)
 * @method DailyWorkDuration[]    findAll()
 * @method DailyWorkDuration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DailyWorkDurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DailyWorkDuration::class);
    }

    // /**
    //  * @return DailyWorkDuration[] Returns an array of DailyWorkDuration objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DailyWorkDuration
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
