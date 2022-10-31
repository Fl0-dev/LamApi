<?php

namespace App\Repository\SubscriptionRepositories\DISC;

use App\Entity\Subscriptions\DISC\DISCPersonality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DISCPersonality>
 *
 * @method DISCPersonality|null find($id, $lockMode = null, $lockVersion = null)
 * @method DISCPersonality|null findOneBy(array $criteria, array $orderBy = null)
 * @method DISCPersonality[]    findAll()
 * @method DISCPersonality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DISCPersonalityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DISCPersonality::class);
    }

    public function save(DISCPersonality $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DISCPersonality $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DISCPersonality[] Returns an array of DISCPersonality objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DISCPersonality
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
