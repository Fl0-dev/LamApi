<?php

namespace App\Repository;

use App\Entity\ApplicantionExchange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicantionExchange>
 *
 * @method ApplicantionExchange|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicantionExchange|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicantionExchange[]    findAll()
 * @method ApplicantionExchange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicantionExchangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicantionExchange::class);
    }

    public function add(ApplicantionExchange $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplicantionExchange $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ApplicantionExchange[] Returns an array of ApplicantionExchange objects
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

//    public function findOneBySomeField($value): ?ApplicantionExchange
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
