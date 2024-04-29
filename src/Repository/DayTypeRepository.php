<?php

namespace App\Repository;

use App\Entity\DayType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DayType>
 *
 * @method DayType|null find($id, $lockMode = null, $lockVersion = null)
 * @method DayType|null findOneBy(array $criteria, array $orderBy = null)
 * @method DayType[]    findAll()
 * @method DayType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DayType::class);
    }

    //    /**
    //     * @return DayType[] Returns an array of DayType objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DayType
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
