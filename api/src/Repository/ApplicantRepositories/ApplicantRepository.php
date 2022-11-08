<?php

namespace App\Repository\ApplicantRepositories;

use App\Entity\Applicant\Applicant;
use App\Utils\Utils;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Applicant>
 *
 * @method Applicant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Applicant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Applicant[]    findAll()
 * @method Applicant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Applicant::class);
    }

    public function add(Applicant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        
        if (Utils::isEmail($entity->getEmail()) && Utils::isPassword($entity->getPassword()) && $flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Applicant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
