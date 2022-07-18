<?php

namespace App\Repository;

use App\Entity\ArticleMagasin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleMagasin|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleMagasin|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleMagasin[]    findAll()
 * @method ArticleMagasin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleMagasinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleMagasin::class);
    }

    // /**
    //  * @return ArticleMagasin[] Returns an array of ArticleMagasin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticleMagasin
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
