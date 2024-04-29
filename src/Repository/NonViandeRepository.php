<?php

namespace App\Repository;

use App\Entity\NonViande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NonViande>
 *
 * @method NonViande|null find($id, $lockMode = null, $lockVersion = null)
 * @method NonViande|null findOneBy(array $criteria, array $orderBy = null)
 * @method NonViande[]    findAll()
 * @method NonViande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NonViandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NonViande::class);
    }

    //    /**
    //     * @return NonViande[] Returns an array of NonViande objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?NonViande
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
