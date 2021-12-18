<?php

namespace App\Repository;

use App\Entity\Reservationparking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservationparking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservationparking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservationparking[]    findAll()
 * @method Reservationparking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationparkingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservationparking::class);
    }

    // /**
    //  * @return Terrain[] Returns an array of Terrain objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Terrain
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}

