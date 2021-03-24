<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wish[]    findAll()
 * @method Wish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }

    public function findWishList(): ?array
    {

        //enQueryBuilder
        $queryBuilder = $this->createQueryBuilder('w');

        //ajoute des clauses WHERE
        $queryBuilder
            ->andWhere('w.isPublished = true')
            ->andWhere('w.likes > 300');

        //le tri
        $queryBuilder->addOrderBy('w.date_created','DESC');

        //nombre max de résultats
        $queryBuilder->setMaxResults(20);

        //on récupère l'objet Query de doctrine
        $query=$queryBuilder->getQuery();

        //on éxécute la requête et on récupère les résultats
        $result=$query->getResult();

        return $result;

        /*
        //en DQL
        $dql = "SELECT w
        FROM App\Entity\Wish w
        WHERE w.isPublished = true
        AND w.likes>300
        ORDER BY w.date_created DESC";

        //on récupère l'entity manager
        $entityManager = $this->getEntityManager();

        //on crée la requête Doctrine
        $query = $entityManager->createQuery($dql);

        //limite le nombre de résultats (équivalent du LIMIT en SQL)
        $query->setMaxResult(20);

        //on exécute la requête et on récupère les résultats
        $result = $query->getResult();

        return $result; */
    }


    // /**
    //  * @return Wish[] Returns an array of Wish objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wish
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
