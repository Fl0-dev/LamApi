<?php

namespace App\Repository\SubscriptionRepositories\Employer;

use App\Entity\Subscriptions\Employer\Lamatch\ApplicantResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicantResult>
 *
 * @method ApplicantResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicantResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicantResult[]    findAll()
 * @method ApplicantResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicantResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicantResult::class);
    }

    public function add(ApplicantResult $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplicantResult $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return ApplicantResult[] Returns an array of ApplicantResult objects
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

    //    public function findOneBySomeField($value): ?ApplicantResult
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
