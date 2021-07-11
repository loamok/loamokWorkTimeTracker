<?php

namespace App\Repository;

use App\Entity\WorkDuration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkDuration|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkDuration|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkDuration[]    findAll()
 * @method WorkDuration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkDurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkDuration::class);
    }

    // /**
    //  * @return WorkDuration[] Returns an array of WorkDuration objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkDuration
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
