<?php

namespace App\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

class JobFilter extends AbstractFilter
{
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null/*, array $context = []*/)
    {
        if ($property !== 'jobTitle' && $property !== 'jobType') {
            return;
        }

        if ($resourceClass === 'App\Entity\JobTitle') {
            $valueParameter = $queryNameGenerator->generateParameterName($property);
            $queryBuilder
                ->andWhere(sprintf('o.slug LIKE :%s', $valueParameter))
                ->setParameter($valueParameter, '%' . strtolower($value) . '%');
        }

        if ($resourceClass === 'App\Entity\JobType') {
            $valueParameter = $queryNameGenerator->generateParameterName($property);
            $queryBuilder
                ->andWhere(sprintf('o.slug LIKE :%s', $valueParameter))
                ->setParameter($valueParameter, '%' . strtolower($value) . '%');
        }
    }

    public function getDescription(string $resourceClass): array
    {
        switch ($resourceClass) {
            case 'App\Entity\JobTitle':
                return [
                    'jobTitle' => [
                        'property' => null,
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search for a job title with keywords',
                        'openapi' => [
                            'example' => 'exp',
                        ],
                    ],
                ];
            case 'App\Entity\JobType':
                return [
                    'jobType' => [
                        'property' => null,
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search for a job type with keywords',
                        'openapi' => [
                            'example' => 'exp',
                        ],
                    ],
                ];
            default:
                return [];
        }
    }
}
