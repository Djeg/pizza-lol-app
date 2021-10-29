<?php

namespace App\Repository;

use App\DTO\KindSearchCriteria;
use App\Entity\Kind;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kind|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kind|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kind[]    findAll()
 * @method Kind[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KindRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kind::class);
    }

    public function findAllByCriteria(KindSearchCriteria $criteria): array
    {
        $queryBuilder = $this
            ->createQueryBuilder('k')
            ->orderBy('k.' . $criteria->orderBy, $criteria->direction)
            ->setMaxResults($criteria->limit)
            ->setFirstResult(($criteria->page - 1) * $criteria->limit);

        if (null !== $criteria->name) {
            $queryBuilder = $queryBuilder
                ->andWhere('k.name LIKE :name')
                ->setParameter('name', '%' . $criteria->name . '%');
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}
