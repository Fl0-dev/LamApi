<?php

namespace App\Filter;

use ApiPlatform\Api\FilterInterface;
use App\Repository\ReferencesRepositories\ContractTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyInfo\Type;

class ContractTypeFilter implements FilterInterface
{
    public const CONTRACT_TYPE_CONTEXT = 'contract_type_context';
    const CONTRACT_TYPE_QUERY_PARAMETER = 'contract_type';

    public function __construct(private ContractTypeRepository $contractTypeRepository)
    {   
    }
    
    public function apply(Request $request, bool $normalization, array $attributes, array &$context)
    {
        $contractType = $request->query->get(self::CONTRACT_TYPE_QUERY_PARAMETER);
        if (!$contractType) {
            return;
        }
        $keywords = strtolower($request->get(self::CONTRACT_TYPE_QUERY_PARAMETER));
        $keywords = trim($keywords);
        $contractTypes = $this->contractTypeRepository->findByKeywords($keywords);
        $context[self::CONTRACT_TYPE_CONTEXT] = $contractTypes;
    }
    
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