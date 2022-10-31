<?php

namespace App\Repository\SubscriptionRepositories\Employer;

use App\Entity\Subscriptions\Employer\Lamatch\EmployerFavoriteCandidat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployerFavoriteCandidat>
 *
 * @method EmployerFavoriteCandidat|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployerFavoriteCandidat|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployerFavoriteCandidat[]    findAll()
 * @method EmployerFavoriteCandidat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployerFavoriteCandidatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployerFavoriteCandidat::class);
    }

    public function save(EmployerFavoriteCandidat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EmployerFavoriteCandidat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EmployerFavoriteCandidat[] Returns an array of EmployerFavoriteCandidat objects
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

//    public function findOneBySomeField($value): ?EmployerFavoriteCandidat
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
