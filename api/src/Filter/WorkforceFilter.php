<?php

namespace App\Filter;

use ApiPlatform\Api\FilterInterface;
use Symfony\Component\PropertyInfo\Type;

class WorkforceFilter implements FilterInterface
{
    public const WORKFORCE_CONTEXT = 'workforce_context';
    public const WORKFORCE_QUERY_PARAMETER = 'workforce';

    public function getDescription(string $resourceClass): array
    {
        return [
            self::WORKFORCE_QUERY_PARAMETER => [
                'property' => null,
                'type' => Type::BUILTIN_TYPE_STRING,
                'required' => false,
                'description' => 'Search worforces with keywords',
                'openapi' => [
                    'example' => '19',
                ],
            ]
        ];
    }
}
