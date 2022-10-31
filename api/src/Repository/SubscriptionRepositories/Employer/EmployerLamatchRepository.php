<?php

namespace App\Repository\SubscriptionRepositories\Employer;

use App\Entity\Subscriptions\Employer\Lamatch\EmployerLamatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployerLamatch>
 *
 * @method EmployerLamatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployerLamatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployerLamatch[]    findAll()
 * @method EmployerLamatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployerLamatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployerLamatch::class);
    }

    public function save(EmployerLamatch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EmployerLamatch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EmployerLamatch[] Returns an array of EmployerLamatch objects
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

//    public function findOneBySomeField($value): ?EmployerLamatch
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
