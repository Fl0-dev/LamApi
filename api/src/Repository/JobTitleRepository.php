<?php

namespace App\Repository;

use App\Entity\JobTitle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobTitle>
 *
 * @method JobTitle|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobTitle|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobTitle[]    findAll()
 * @method JobTitle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobTitleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobTitle::class);
    }

    public function add(JobTitle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JobTitle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBySlug(string $slug): ?JobTitle
    {
        return $this->findOneBy(['slug' => $slug]);
    }
}
