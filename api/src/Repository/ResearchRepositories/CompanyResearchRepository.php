<?php

namespace App\Repository\ResearchRepositories;

use App\Entity\Research\CompanyResearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyResearch>
 *
 * @method CompanyResearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyResearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyResearch[]    findAll()
 * @method CompanyResearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyResearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyResearch::class);
    }

    public function add(CompanyResearch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanyResearch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
