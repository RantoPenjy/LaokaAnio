<?php

namespace App\Repository;

use App\Entity\Viande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Viande>
 *
 * @method Viande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Viande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Viande[]    findAll()
 * @method Viande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ViandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Viande::class);
    }

    //    /**
    //     * @return Viande[] Returns an array of Viande objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Viande
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
