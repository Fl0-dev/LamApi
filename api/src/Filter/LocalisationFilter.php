<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\QueryBuilder;

class LocalisationFilter extends AbstractFilter
{
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null/*, array $context = []*/)
    {
        if ($property !== 'localisation') {
            return;
        }
        
        if ($resourceClass === 'App\Entity\CompanyGroup') {
            $valueParameter = $queryNameGenerator->generateParameterName($property);
            $queryBuilder
                ->join('o.companyEntities', 'ce', 'WITH', 'ce.companyGroup = o.id')
                ->join('ce.addresses', 'a', 'WITH', 'a MEMBER OF ce.addresses')
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
                ->join('o.companyEntity', 'ce', 'WITH', 'ce.id = o.companyEntity')
                ->join('ce.addresses', 'a', 'WITH', 'a MEMBER OF ce.addresses')
                ->join('a.city', 'c', 'WITH', 'c.id = a.city')
                ->join('c.department', 'd', 'WITH', 'd.id = c.department')
                ->andWhere(sprintf('c.slug LIKE :%s OR d.slug LIKE :%s', $valueParameter, $valueParameter))
                ->setParameter($valueParameter, '%' . strtolower($value) . '%');
        }
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'localisation' => [
                'property' => null,
                'type' => 'string',
                'required' => false,
                'description' => 'Search for a city or department name',
            ]
        ];
    }
}