<?php

namespace App\Repository\RevisionRepositories;

use App\Entity\Revision\CompanyEntityRevision;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyEntityRevision>
 *
 * @method CompanyEntityRevision|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyEntityRevision|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyEntityRevision[]    findAll()
 * @method CompanyEntityRevision[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyEntityRevisionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyEntityRevision::class);
    }

    public function add(CompanyEntityRevision $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanyEntityRevision $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
