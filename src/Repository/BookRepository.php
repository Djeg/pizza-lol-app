<?php

namespace App\Repository;

use App\Entity\Book;
use App\DTO\BookSearchCriteria;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
     * Retrieve the last inserted books
     */
    public function findLast(int $number = 10): array
    {
        return $this->createQueryBuilder('book')
            ->orderBy('book.updatedAt', 'DESC')
            ->setMaxResults($number)
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupére tout les livres en utilisant de critéres de recherche
     */
    public function findByCriteria(BookSearchCriteria $criteria): array
    {
        $qb = $this->createQueryBuilder('book')
            ->setMaxResults($criteria->limit)
            ->setFirstResult(($criteria->page - 1) * $criteria->limit)
            ->orderBy("book.{$criteria->orderBy}", $criteria->direction);

        if (null !== $criteria->title) {
            $qb = $qb->andWhere('book.title LIKE :title')->setParameter('title', "%{$criteria->title}%");
        }

        if (null !== $criteria->minPrice) {
            $qb = $qb->andWhere('book.price >= :minPrice')->setParameter('minPrice', $criteria->minPrice);
        }

        if (null !== $criteria->maxPrice) {
            $qb = $qb->andWhere('book.price <= :maxPrice')->setParameter('maxPrice', $criteria->maxPrice);
        }

        if (null !== $criteria->author) {
            $qb = $qb
                ->leftJoin('book.author', 'author')
                ->andWhere('CONCAT(author.firstname, CONCAT(\' \', author.lastname)) LIKE :author')
                ->setParameter('author', "%{$criteria->author}%");
        }

        if (null !== $criteria->category) {
            $qb = $qb
                ->leftJoin('book.category', 'category')
                ->andWhere('category.title LIKE :category')
                ->setParameter('category', "%{$criteria->category}%");
        }

        if (null !== $criteria->dealer) {
            $qb = $qb
                ->leftJoin('book.dealer', 'dealer')
                ->andWhere('dealer.email LIKE :dealer')
                ->setParameter('dealer', "%{$criteria->dealer}%");
        }

        return $qb->getQuery()->getResult();
    }
}
