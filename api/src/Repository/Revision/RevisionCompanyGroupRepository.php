<?php

namespace App\Repository\Revision;

use App\Entity\Revision\RevisionCompanyGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RevisionCompanyGroup>
 *
 * @method RevisionCompanyGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method RevisionCompanyGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method RevisionCompanyGroup[]    findAll()
 * @method RevisionCompanyGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RevisionCompanyGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RevisionCompanyGroup::class);
    }

    public function add(RevisionCompanyGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RevisionCompanyGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RevisionCompanyGroup[] Returns an array of RevisionCompanyGroup objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RevisionCompanyGroup
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
