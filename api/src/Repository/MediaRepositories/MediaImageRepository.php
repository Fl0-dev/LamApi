<?php

namespace App\Repository\MediaRepositories;

use App\Entity\Media\MediaImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MediaImage>
 *
 * @method MediaImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method MediaImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method MediaImage[]    findAll()
 * @method MediaImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediaImage::class);
    }

    public function add(MediaImage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MediaImage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
