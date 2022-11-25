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

    public function add(ApplicantLamatchSubscription $entity, bool $flush = false): void
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
}
