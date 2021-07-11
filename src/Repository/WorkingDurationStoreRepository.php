<?php

namespace App\Repository;

use App\Entity\WorkingDurationStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkingDurationStore|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkingDurationStore|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkingDurationStore[]    findAll()
 * @method WorkingDurationStore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkingDurationStoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkingDurationStore::class);
    }

    // /**
    //  * @return WorkingDurationStore[] Returns an array of WorkingDurationStore objects
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
    public function findOneBySomeField($value): ?WorkingDurationStore
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
