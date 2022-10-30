<?php

namespace App\Repository\SubscriptionRepositories\Applicant;

use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchSubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicantLamatchSubscription>
 *
 * @method ApplicantLamatchSubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicantLamatchSubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicantLamatchSubscription[] findAll()
 * @method ApplicantLamatchSubscription[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicantLamatchSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicantLamatchSubscription::class);
    }

    public function save(ApplicantLamatchSubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplicantLamatchSubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ApplicantLamatchSubscription[] Returns an array of ApplicantLamatchSubscription objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ApplicantLamatchSubscription
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
