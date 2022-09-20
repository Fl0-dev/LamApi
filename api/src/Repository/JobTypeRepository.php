<?php

namespace App\Repository;

use App\Entity\JobType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobType>
 *
 * @method JobType|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobType|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobType[]    findAll()
 * @method JobType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobType::class);
    }

    public function add(JobType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JobType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
