<?php

namespace App\Repository;

use App\Entity\Ats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ats>
 *
 * @method Ats|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ats|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ats[]    findAll()
 * @method Ats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ats::class);
    }

    public function add(Ats $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ats $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
