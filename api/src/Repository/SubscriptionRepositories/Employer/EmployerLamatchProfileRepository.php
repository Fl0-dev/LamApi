<?php

namespace App\Repository\SubscriptionRepositories\Employer;

use App\Entity\Subscriptions\Employer\Lamatch\EmployerLamatchProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployerLamatchProfile>
 *
 * @method EmployerLamatchProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployerLamatchProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployerLamatchProfile[]    findAll()
 * @method EmployerLamatchProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployerLamatchProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployerLamatchProfile::class);
    }

    public function save(EmployerLamatchProfile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EmployerLamatchProfile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EmployerLamatchProfile[] Returns an array of EmployerLamatchProfile objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EmployerLamatchProfile
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
