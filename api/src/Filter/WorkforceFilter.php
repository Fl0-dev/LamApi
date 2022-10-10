<?php

namespace App\Filter;

use ApiPlatform\Api\FilterInterface;
use App\Repository\ReferencesRepositories\WorkforceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyInfo\Type;

class WorkforceFilter implements FilterInterface
{
    public const WORKFORCE_CONTEXT = 'workforce_context';
    const WORKFORCE_QUERY_PARAMETER = 'workforce';

    public function __construct(private WorkforceRepository $workforceRepository)
    {   
    }
    
    public function apply(Request $request, bool $normalization, array $attributes, array &$context)
    {
        dd($request);
        $workforce = $request->query->get(self::WORKFORCE_QUERY_PARAMETER);
        if (!$workforce) {

            return;
        }

        $keywords = strtolower($request->get(self::WORKFORCE_QUERY_PARAMETER));
        $keywords = trim($keywords);
        $workforces = $this->workforceRepository->findByKeywords($keywords);
        $context[self::WORKFORCE_CONTEXT] = $workforces;
    }
    
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
