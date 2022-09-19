<?php

namespace App\Repository\Company;

use App\Entity\Company\CompanyEntityHasMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyEntityHasMedia>
 *
 * @method CompanyEntityHasMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyEntityHasMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyEntityHasMedia[]    findAll()
 * @method CompanyEntityHasMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyEntityHasMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyEntityHasMedia::class);
    }

    public function add(CompanyEntityHasMedia $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanyEntityHasMedia $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CompanyEntityHasMedia[] Returns an array of CompanyEntityHasMedia objects
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

//    public function findOneBySomeField($value): ?CompanyEntityHasMedia
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
