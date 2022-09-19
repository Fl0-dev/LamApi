<?php

namespace App\Repository\RevisionRepositories;

use App\Entity\Revision\CompanyGroupRevision;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyGroupRevision>
 *
 * @method CompanyGroupRevision|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyGroupRevision|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyGroupRevision[]    findAll()
 * @method CompanyGroupRevision[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyGroupRevisionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyGroupRevision::class);
    }

    public function add(CompanyGroupRevision $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanyGroupRevision $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
