<?php

namespace App\Repository;

use App\Entity\BrewerEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BrewerEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrewerEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrewerEntity[]    findAll()
 * @method BrewerEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrewerEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrewerEntity::class);
    }

    // /**
    //  * @return BrewerEntity[] Returns an array of BrewerEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BrewerEntity
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
