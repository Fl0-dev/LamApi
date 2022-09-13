<?php

namespace App\Repository\ResearchRepositories;

use App\Entity\Research\OfferResearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OfferResearch>
 *
 * @method OfferResearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method OfferResearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method OfferResearch[]    findAll()
 * @method OfferResearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferResearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OfferResearch::class);
    }

    public function add(OfferResearch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OfferResearch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
