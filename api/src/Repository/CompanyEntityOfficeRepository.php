<?php

namespace App\Repository;

use App\Entity\CompanyEntityOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyEntityOffice>
 *
 * @method CompanyEntityOffice|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyEntityOffice|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyEntityOffice[]    findAll()
 * @method CompanyEntityOffice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyEntityOfficeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyEntityOffice::class);
    }

    public function add(CompanyEntityOffice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanyEntityOffice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CompanyEntityOffice[] Returns an array of CompanyEntityOffice objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CompanyEntityOffice
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
