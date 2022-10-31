<?php

namespace App\Repository\SubscriptionRepositories\Applicant;

use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicantLamatch>
 *
 * @method ApplicantLamatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicantLamatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicantLamatch[]    findAll()
 * @method ApplicantLamatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicantLamatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicantLamatch::class);
    }

    public function save(ApplicantLamatch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplicantLamatch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ApplicantLamatch[] Returns an array of ApplicantLamatch objects
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

//    public function findOneBySomeField($value): ?ApplicantLamatch
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
