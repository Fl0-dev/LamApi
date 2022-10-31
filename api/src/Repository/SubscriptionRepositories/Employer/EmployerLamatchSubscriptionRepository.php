<?php

namespace App\Repository\SubscriptionRepositories\Employer;

use App\Entity\Subscriptions\Employer\Lamatch\EmployerLamatchSubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployerLamatchSubscription>
 *
 * @method EmployerLamatchSubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployerLamatchSubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployerLamatchSubscription[] findAll()
 * @method EmployerLamatchSubscription[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployerLamatchSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployerLamatchSubscription::class);
    }

    public function save(EmployerLamatchSubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EmployerLamatchSubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EmployerLamatchSubscription[] Returns an array of EmployerLamatchSubscription objects
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

//    public function findOneBySomeField($value): ?EmployerLamatchSubscription
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
