<?php

namespace App\Repository\LocationRepositories;

use App\Entity\Location\Address;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Address>
 *
 * @method Address|null find($id, $lockMode = null, $lockVersion = null)
 * @method Address|null findOneBy(array $criteria, array $orderBy = null)
 * @method Address[]    findAll()
 * @method Address[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }

    public function add(Address $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Address $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllCodeWithAddress()
    {
        $query = $this->createQueryBuilder('a')
            ->select('d.code')
            ->join('a.city', 'c')
            ->join('c.department', 'd')
            ->groupBy('d.code')
            ->getQuery();

        return $query->getResult();
    }

    public function localisationByKeyWords($keyWords)
    {
        $cityQuery = $this->createQueryBuilder('a')
            ->select('c.id as cityId, c.name as cityName')
            ->join('a.city', 'c')
            ->Where('c.slug LIKE :keyWords')
            ->groupBy('c.id')
            ->setParameter('keyWords', '%' . strtolower($keyWords) . '%')
            ->getQuery();
            $cityResult = $cityQuery->getResult();

        $departmentQuery = $this->createQueryBuilder('a')
            ->select('d.id as departmentId, d.name as departmentName')
            ->join('a.city', 'c')
            ->join('c.department', 'd')
            ->Where('d.slug LIKE :keyWords')
            ->groupBy('d.id')
            ->setParameter('keyWords', '%' . strtolower($keyWords) . '%')
            ->getQuery();
            $departmentResult = $departmentQuery->getResult();

        return array_merge($cityResult, $departmentResult);
    }
}
