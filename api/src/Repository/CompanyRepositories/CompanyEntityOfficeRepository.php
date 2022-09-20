<?php

namespace App\Repository\CompanyRepositories;

use App\Entity\Company\CompanyEntityOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyEntityOffice>
 *
 * @method CompanyEntityOffice|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyEntityOffice|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyEntityOffice[]    findAll()
 * @method CompanyEntityOffice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyEntityOfficeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyEntityOffice::class);
    }

    public function add(CompanyEntityOffice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanyEntityOffice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
