<?php

namespace App\Repository;

use App\Entity\CompanyGroupTeamMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyGroupTeamMedia>
 *
 * @method CompanyGroupTeamMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyGroupTeamMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyGroupTeamMedia[]    findAll()
 * @method CompanyGroupTeamMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyGroupTeamMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyGroupTeamMedia::class);
    }

    public function add(CompanyGroupTeamMedia $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanyGroupTeamMedia $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CompanyGroupTeamMedia[] Returns an array of CompanyGroupTeamMedia objects
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

//    public function findOneBySomeField($value): ?CompanyGroupTeamMedia
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
