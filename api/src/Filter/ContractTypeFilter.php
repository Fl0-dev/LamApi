<?php

namespace App\Filter;

use ApiPlatform\Core\Serializer\Filter\FilterInterface;

use App\Repository\ContractTypeRepository;
use Symfony\Component\HttpFoundation\Request;

class ContractTypeFilter implements FilterInterface
{
    public const CONTRACT_TYPE_CONTEXT = 'contract_type_context';

    public function __construct(private ContractTypeRepository $contractTypeRepository)
    {   
    }
    
    public function apply(Request $request, bool $normalization, array $attributes, array &$context)
    {
        $contractType = $request->query->get('contractType');
        if (!$contractType) {
            return;
        }
        $keywords = strtolower($request->get('contractType'));
        $keywords = trim($keywords);
        $contractTypes = $this->contractTypeRepository->findByKeywords($keywords);
        $context[self::CONTRACT_TYPE_CONTEXT] = $contractTypes;
    }
    
    public function getDescription(string $resourceClass): array
    {
        return [
            'contractType' => [
                'property' => null,
                'type' => 'string',
                'required' => false,
                'description' => 'Search contractTypes with keywords',
                'openapi' => [
                    'example' => 'cdd',
                ],
    
            ]
        ];
    }
}