<?php

namespace App\Repository;

use App\Entity\Article;
use App\DTO\ArticleSearchCriteria;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findAllByCriteria(ArticleSearchCriteria $criteria): array
    {
        $queryBuilder = $this
            ->createQueryBuilder('article')
            ->setMaxResults($criteria->limit)
            // 25 - 1 => 25 * (1 - 1) => 25 * 0 => 0
            // 25 - 2 => 25 * (2 - 1) => 25 * 1 => 25
            // 25 - 3 => 25 * (3 - 1) => 25 * 2 => 50
            ->setFirstResult($criteria->limit * ($criteria->page - 1))
            ->orderBy("article.{$criteria->orderBy}", $criteria->direction);

        if ($criteria->search) {
            $queryBuilder = $queryBuilder
                ->andWhere("article.title LIKE :title")
                ->setParameter('title', "%{$criteria->search}%");
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function findLast(int $limit = 10): array
    {
        // Doctrine met à disposition une class nommé le QueryBuilder
        // Cette class permet de faire des requête à notre base de données

        // Pout récupérer un query builder il faut utiliser :
        // C'est l'équivalent de la requête SQL suivante :
        // SELECT * FROM article AS article
        // $queryBuilder = $this
        //     ->createQueryBuilder('article')
        //     ->andWhere('article.title = "test"')
        //     ->orWhere('article.description LIKE test%')
        //     ->orderBy('article.title', 'DESC')
        //     ->setMaxResults(10)
        //     ->setFirstResult(0)
        //     ->getQuery() // Générer la requête SQL
        //     ->getResult() // Éxécuter la requête SQL
        // ;

        return $this
            ->createQueryBuilder('article')
            ->orderBy('article.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
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
