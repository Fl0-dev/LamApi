<?php

namespace App\Repository\UserRepositories;

use App\Entity\User\Employer;
use App\Utils\Utils;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Employer>
 *
 * @method Employer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employer[]    findAll()
 * @method Employer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employer::class);
    }

    public function add(Employer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if (Utils::isEmail($entity->getEmail()) && Utils::isPassword($entity->getPassword()) && $flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Employer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
