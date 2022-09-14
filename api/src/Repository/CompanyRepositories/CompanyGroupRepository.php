<?php

namespace App\Repository\CompanyRepositories;

use App\Entity\Company\CompanyGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyGroup>
 *
 * @method CompanyGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyGroup[]    findAll()
 * @method CompanyGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyGroup::class);
    }

    public function add(CompanyGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanyGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findNameByPartialSlug(string $keywords): array
    {
        $qb = $this->createQueryBuilder('cg');
        $qb
            ->select('cg.name')
            ->where($qb->expr()->like('cg.slug', ':keywords'))
            ->setParameter('keywords', '%' . $keywords . '%');
        return $qb->getQuery()->getResult();
    }
}
