<?php

namespace App\Repository\ApplicantRepositories;

use App\Entity\Applicant\ApplicantStatusHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicantStatusHistory>
 *
 * @method ApplicantStatusHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicantStatusHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicantStatusHistory[]    findAll()
 * @method ApplicantStatusHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicantStatusHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicantStatusHistory::class);
    }

    public function add(ApplicantStatusHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplicantStatusHistory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
