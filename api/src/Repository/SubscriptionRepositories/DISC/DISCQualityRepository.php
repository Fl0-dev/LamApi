<?php

namespace App\Repository\SubscriptionRepositories\DISC;

use App\Entity\Subscriptions\DISC\DISCQuality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DISCQuality>
 *
 * @method DISCQuality|null find($id, $lockMode = null, $lockVersion = null)
 * @method DISCQuality|null findOneBy(array $criteria, array $orderBy = null)
 * @method DISCQuality[]    findAll()
 * @method DISCQuality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DISCQualityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DISCQuality::class);
    }

    public function save(DISCQuality $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DISCQuality $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DISCQuality[] Returns an array of DISCQuality objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DISCQuality
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
