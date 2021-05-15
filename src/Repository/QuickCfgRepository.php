<?php

namespace App\Repository;

use App\Entity\QuickCfg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuickCfg|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuickCfg|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuickCfg[]    findAll()
 * @method QuickCfg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuickCfgRepository extends ServiceEntityRepository {
    
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, QuickCfg::class);
    }

    // /**
    //  * @return QuickCfg[] Returns an array of QuickCfg objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Plop
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
