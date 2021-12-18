<?php

namespace App\Repository;
use App\Classe\Search;
use App\Data\SearchData;
use App\Entity\Produit;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\FormTypeInterface;


/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    /**
     *
     * @return Produit[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this->createQueryBuilder('p')
        ->select('c','p')
        ->join('p.idCategorie','c');

        if(!empty($search->categories)){
            $query = $query
                ->andWhere('c.idCategorie IN (:categories)')
                ->setParameter('categories',$search->categories);
        }
        if(!empty($search->string)) {
            $query = $query
                ->andWhere('p.nomProduit LIKE :string')
                ->setParameter('string',"%{$search->string}%");
        }
        return $query->getQuery()->getResult();


    }




    // /**
    //  * @return Produit[] Returns an array of Produit objects
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
    public function findOneBySomeField($value): ?Produit
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
