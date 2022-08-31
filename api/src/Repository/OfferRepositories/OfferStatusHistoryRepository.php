<?php

namespace App\Repository\OfferRepositories;

use App\Entity\Offer\OfferStatusHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OfferStatusHistory>
 *
 * @method OfferStatusHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method OfferStatusHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method OfferStatusHistory[]    findAll()
 * @method OfferStatusHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferStatusHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OfferStatusHistory::class);
    }

    public function add(OfferStatusHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OfferStatusHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OfferStatusHistory[] Returns an array of OfferStatusHistory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OfferStatusHistory
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
