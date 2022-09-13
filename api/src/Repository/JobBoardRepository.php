<?php

namespace App\Repository;

use App\Entity\JobBoard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobBoard>
 *
 * @method JobBoard|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobBoard|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobBoard[]    findAll()
 * @method JobBoard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobBoardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobBoard::class);
    }

    public function add(JobBoard $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JobBoard $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
