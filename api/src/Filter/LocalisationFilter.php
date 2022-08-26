<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

class LocationFilter extends AbstractFilter
{
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null/*, array $context = []*/)
    {
        if ($property !== 'location') {
            return;
        }

        if ($resourceClass === 'App\Entity\CompanyGroup') {
            $valueParameter = $queryNameGenerator->generateParameterName($property);

            $queryBuilder
                ->join('o.companyEntities', 'ce', 'WITH', 'ce.companyGroup = o.id')
                ->join('ce.companyEntityOffices', 'cb', 'WITH', 'cb MEMBER OF ce.companyEntityOffices')
                ->join('cb.address', 'a', 'WITH', 'cb.address = a.id')
                ->join('a.city', 'c', 'WITH', 'c.id = a.city')
                ->join('c.department', 'd', 'WITH', 'd.id = c.department')
                ->andWhere(sprintf('c.slug LIKE :%s OR d.slug LIKE :%s', $valueParameter, $valueParameter))
                ->setParameter($valueParameter, '%' . strtolower($value) . '%');
        }

        if ($resourceClass === 'App\Entity\City') {
            $valueParameter = $queryNameGenerator->generateParameterName($property);
            $queryBuilder
                ->join('o.department', 'd', 'WITH', 'd.id = o.department')
                ->andWhere(sprintf('o.slug LIKE :%s OR d.slug LIKE :%s', $valueParameter, $valueParameter))
                ->setParameter($valueParameter, '%' . strtolower($value) . '%');
        }

        if ($resourceClass === 'App\Entity\Offer') {
            $valueParameter = $queryNameGenerator->generateParameterName($property);
            $queryBuilder
                ->join('o.companyEntityOffice', 'b', 'WITH', 'b.id = o.companyEntityOffice')
                ->join('b.address', 'a', 'WITH', 'b.address = a.id ')
                ->join('a.city', 'c', 'WITH', 'c.id = a.city')
                ->join('c.department', 'd', 'WITH', 'd.id = c.department')
                ->andWhere(sprintf('c.slug LIKE :%s OR d.slug LIKE :%s', $valueParameter, $valueParameter))
                ->setParameter($valueParameter, '%' . strtolower($value) . '%');
        }
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'location' => [
                'property' => null,
                'type' => 'string',
                'required' => false,
                'description' => 'Search for a city or department name',
            ]
        ];
    }
}
