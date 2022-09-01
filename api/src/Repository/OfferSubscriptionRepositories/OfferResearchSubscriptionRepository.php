<?php

namespace App\Repository\OfferSubscriptionRepositories;

use App\Entity\OfferSubscription\OfferResearchSubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OfferResearchSubscription>
 *
 * @method OfferResearchSubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method OfferResearchSubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method OfferResearchSubscription[]    findAll()
 * @method OfferResearchSubscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferResearchSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OfferResearchSubscription::class);
    }

    public function add(OfferResearchSubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OfferResearchSubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OfferResearchSubscription[] Returns an array of OfferResearchSubscription objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OfferResearchSubscription
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
