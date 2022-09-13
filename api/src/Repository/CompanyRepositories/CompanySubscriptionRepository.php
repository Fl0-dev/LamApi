<?php

namespace App\Repository\CompanyRepositories;

use App\Entity\Company\CompanySubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanySubscription>
 *
 * @method CompanySubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanySubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanySubscription[]    findAll()
 * @method CompanySubscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanySubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanySubscription::class);
    }

    public function add(CompanySubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanySubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
