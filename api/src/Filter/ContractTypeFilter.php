<?php

namespace App\Filter;

use ApiPlatform\Api\FilterInterface;
use Symfony\Component\PropertyInfo\Type;

class ContractTypeFilter implements FilterInterface
{
    public const CONTRACT_TYPE_CONTEXT = 'contract_type_context';
    const CONTRACT_TYPE_QUERY_PARAMETER = 'contract_type';
    
    public function getDescription(string $resourceClass): array
    {
        return [
            self::CONTRACT_TYPE_QUERY_PARAMETER => [
                'property' => null,
                'type' => Type::BUILTIN_TYPE_STRING,
                'required' => false,
                'description' => 'Search contractTypes with keywords',
                'openapi' => [
                    'example' => 'cdd',
                ],
    
            ]
        ];
    }
}