<?php

namespace App\Repository;

use App\Entity\BeerEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BeerEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method BeerEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method BeerEntity[]    findAll()
 * @method BeerEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeerEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BeerEntity::class);
    }

    // /**
    //  * @return BeerEntity[] Returns an array of BeerEntity objects
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
    public function findOneBySomeField($value): ?BeerEntity
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
