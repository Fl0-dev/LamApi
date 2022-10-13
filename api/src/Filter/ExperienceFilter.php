<?php

namespace App\Filter;

use ApiPlatform\Api\FilterInterface;
use Symfony\Component\PropertyInfo\Type;

class ExperienceFilter implements FilterInterface
{
    public const EXPERIENCE_CONTEXT = 'experience_context';
    public const EXPERIENCE_QUERY_PARAMETER = 'experience';

    public function getDescription(string $resourceClass): array
    {
        return [
            self::EXPERIENCE_QUERY_PARAMETER => [
                'property' => null,
                'type' => Type::BUILTIN_TYPE_STRING,
                'required' => false,
                'description' => 'Search experiences with keywords',
                'openapi' => [
                ],

            ]
        ];
    }
}
