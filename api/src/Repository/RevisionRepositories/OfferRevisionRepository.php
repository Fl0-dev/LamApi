<?php

namespace App\Repository\RevisionRepositories;

use App\Entity\Revision\OfferRevision;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OfferRevision>
 *
 * @method OfferRevision|null find($id, $lockMode = null, $lockVersion = null)
 * @method OfferRevision|null findOneBy(array $criteria, array $orderBy = null)
 * @method OfferRevision[]    findAll()
 * @method OfferRevision[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRevisionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OfferRevision::class);
    }

    public function add(OfferRevision $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OfferRevision $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
