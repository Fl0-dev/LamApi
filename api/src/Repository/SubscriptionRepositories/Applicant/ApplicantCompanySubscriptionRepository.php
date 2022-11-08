<?php

namespace App\Repository\SubscriptionRepositories\Applicant;

use App\Entity\Subscriptions\Applicant\ApplicantCompanySubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicantCompanySubscription>
 *
 * @method ApplicantCompanySubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicantCompanySubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicantCompanySubscription[] findAll()
 * @method ApplicantCompanySubscription[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicantCompanySubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicantCompanySubscription::class);
    }

    public function add(ApplicantCompanySubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplicantCompanySubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return ApplicantCompanySubscription[] Returns an array of ApplicantCompanySubscription objects
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

    //    public function findOneBySomeField($value): ?ApplicantCompanySubscription
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
