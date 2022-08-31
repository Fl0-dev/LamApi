<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\PropertyInfo\Type;

class LocationFilter extends AbstractFilter
{
    const LOCATION_QUERY_PARAMETER = 'location';

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null/*, array $context = []*/)
    {
        if ($property !== self::LOCATION_QUERY_PARAMETER) {
            return;
        }

        if ($resourceClass === 'App\Entity\City') {
            $valueParameter = $queryNameGenerator->generateParameterName($property);
            $queryBuilder
                ->join('o.department', 'd', 'WITH', 'd.id = o.department')
                ->andWhere(sprintf('o.slug LIKE :%s OR d.slug LIKE :%s', $valueParameter, $valueParameter))
                ->setParameter($valueParameter, '%' . strtolower($value) . '%');
        }
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            self::LOCATION_QUERY_PARAMETER => [
                'property' => 'null',
                'type' => Type::BUILTIN_TYPE_STRING,
                'required' => false,
                'description' => 'Search locations with keywords',
            ],
        ];
    }
}
