<?php

namespace App\Repository\SubscriptionRepositories\Applicant;

use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicantLamatchProfile>
 *
 * @method ApplicantLamatchProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicantLamatchProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicantLamatchProfile[]    findAll()
 * @method ApplicantLamatchProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicantLamatchProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicantLamatchProfile::class);
    }

    public function add(ApplicantLamatchProfile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplicantLamatchProfile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return ApplicantLamatchProfile[] Returns an array of ApplicantLamatchProfile objects
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

    //    public function findOneBySomeField($value): ?ApplicantLamatchProfile
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
