<?php

namespace App\Repository\ApplicationRepositories;

use App\Entity\Application\ApplicationExchange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApplicationExchange>
 *
 * @method ApplicationExchange|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationExchange|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationExchange[]    findAll()
 * @method ApplicationExchange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationExchangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApplicationExchange::class);
    }

    public function add(ApplicationExchange $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApplicationExchange $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
