<?php

namespace App\Repository;

use App\Entity\Intervation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Intervation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Intervation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Intervation[]    findAll()
 * @method Intervation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntervationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Intervation::class);
    }

    // /**
    //  * @return Intervation[] Returns an array of Intervation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Intervation
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
