<?php

namespace App\Repository\ApplicationRepositories;

use App\Entity\Application\ApplicationHasStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicationHasStatus>
 *
 * @method ApplicationHasStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationHasStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationHasStatus[]    findAll()
 * @method ApplicationHasStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationHasStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationHasStatus::class);
    }

    public function add(ApplicationHasStatus $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplicationHasStatus $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
