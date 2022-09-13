<?php

namespace App\Repository\CompanyRepositories;

use App\Entity\Company\CompanyGroupHasSubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyGroupHasSubscription>
 *
 * @method CompanyGroupHasSubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyGroupHasSubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyGroupHasSubscription[]    findAll()
 * @method CompanyGroupHasSubscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyGroupHasSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyGroupHasSubscription::class);
    }

    public function add(CompanyGroupHasSubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanyGroupHasSubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
