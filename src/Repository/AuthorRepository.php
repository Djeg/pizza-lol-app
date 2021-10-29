<?php

namespace App\Repository;

use App\Entity\Author;
use App\DTO\AuthorSearchCriteria;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function findLast(int $limit = 10): array
    {
        return $this
            ->createQueryBuilder('author')
            ->orderBy('author.updatedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findAllByCriteria(AuthorSearchCriteria $criteria): array
    {
        $queryBuilder = $this
            ->createQueryBuilder('a')
            ->orderBy('a.' . $criteria->orderBy, $criteria->direction)
            ->setMaxResults($criteria->limit)
            ->setFirstResult(($criteria->page - 1) * $criteria->limit);

        if (null !== $criteria->name) {
            $queryBuilder = $queryBuilder
                ->andWhere('a.name LIKE :name')
                ->setParameter('name', '%' . $criteria->name . '%');
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}
