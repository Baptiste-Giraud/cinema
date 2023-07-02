<?php

namespace App\Repository;

use App\Entity\MovieHasPeople;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MovieHasPeople>
 *
 * @method MovieHasPeople|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieHasPeople|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieHasPeople[]    findAll()
 * @method MovieHasPeople[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieHasPeopleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieHasPeople::class);
    }

    public function save(MovieHasPeople $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MovieHasPeople $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MovieHasPeople[] Returns an array of MovieHasPeople objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MovieHasPeople
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
