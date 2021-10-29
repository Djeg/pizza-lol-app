<?php

namespace App\Repository;

use App\DTO\BookSearchCriteria;
use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * Retrieve the 10 last books
     */
    public function findLast(int $limit = 10): array
    {
        return $this
            ->createQueryBuilder('book')
            ->orderBy('book.updatedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Retrieve books by there search criterias
     */
    public function findAllByCriteria(BookSearchCriteria $criteria): array
    {
        $builder = $this
            ->createQueryBuilder('book')
            ->setMaxResults($criteria->limit)
            ->setFirstResult(($criteria->page - 1) * $criteria->limit)
            ->orderBy("book.{$criteria->orderBy}", $criteria->direction);

        if (null !== $criteria->name && !empty($criteria->name)) {
            $builder = $builder
                ->andWhere('book.name LIKE :name')
                ->setParameter('name', "%{$criteria->name}%");
        }

        if (null !== $criteria->minPrice) {
            $builder = $builder
                ->andWhere('book.price >= :minPrice')
                ->setParameter('minPrice', $criteria->minPrice);
        }

        if (null !== $criteria->maxPrice) {
            $builder = $builder
                ->andWhere('book.price <= :maxPrice')
                ->setParameter('maxPrice', $criteria->maxPrice);
        }

        if (null !== $criteria->author) {
            $builder = $builder
                ->addSelect('author')
                ->leftJoin('book.author', 'author')
                ->andWhere('author.id = :author')
                ->setParameter('author', $criteria->author->getId());
        }


        if (null !== $criteria->kinds && !$criteria->kinds->isEmpty()) {
            $builder = $builder
                ->addSelect('kind')
                ->leftJoin('book.kind',  'kind')
                ->andWhere('kind.id IN (:kinds)')
                ->setParameter('kinds', $criteria->kinds);
        }

        return $builder
            ->getQuery()
            ->getResult();
    }
}
