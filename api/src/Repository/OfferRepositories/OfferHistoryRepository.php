<?php

namespace App\Repository\OfferRepositories;

use App\Entity\Offer\OfferHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OfferStatusHistory>
 *
 * @method OfferStatusHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method OfferStatusHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method OfferStatusHistory[]    findAll()
 * @method OfferStatusHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OfferHistory::class);
    }

    public function add(OfferHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OfferHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
