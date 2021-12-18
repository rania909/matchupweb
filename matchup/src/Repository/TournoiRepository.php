<?php


namespace App\Repository;
use App\Entity\Tournoi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @method Tournoi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tournoi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tournoi[]    findAll()
 * @method Tournoi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class TournoiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tournoi::class);
    }

    public function search($nomTournoi) {
        return $this->createQueryBuilder('Tournoi')
            ->andWhere('Tournois.nomTournoi LIKE :nomTournoi')
            ->setParameter('nomTournoi', '%'.$nomTournoi.'%')
            ->getQuery()
            ->getResult();
    }
}





