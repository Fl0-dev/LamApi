<?php

namespace App\Repository\ApplicationRepositories;

use App\Entity\Application\ApplicationHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicationHistory>
 *
 * @method ApplicationHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationHistory[]    findAll()
 * @method ApplicationHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationHistory::class);
    }

    public function add(ApplicationHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplicationHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
