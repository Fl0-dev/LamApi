<?php

namespace App\Repository\SubscriptionRepositories\Applicant;

use App\Entity\Subscriptions\Applicant\Lamatch\DesiredLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DesiredLocation>
 *
 * @method DesiredLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method DesiredLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method DesiredLocation[]    findAll()
 * @method DesiredLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DesiredLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DesiredLocation::class);
    }

    public function save(DesiredLocation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DesiredLocation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DesiredLocation[] Returns an array of DesiredLocation objects
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

//    public function findOneBySomeField($value): ?DesiredLocation
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
