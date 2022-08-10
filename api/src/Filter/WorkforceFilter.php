<?php

namespace App\Filter;

use ApiPlatform\Core\Serializer\Filter\FilterInterface;

use App\Repository\WorkforceRepository;
use Symfony\Component\HttpFoundation\Request;

class WorkforceFilter implements FilterInterface
{
    public const WORKFORCE_CONTEXT = 'workforce_context';

    public function __construct(private WorkforceRepository $workforceRepository)
    {   
    }
    
    public function apply(Request $request, bool $normalization, array $attributes, array &$context)
    {
        $workforce = $request->query->get('workforce');
        if (!$workforce) {
            return;
        }
        $keywords = strtolower($request->get('workforce'));
        $keywords = trim($keywords);
        $workforces = $this->workforceRepository->findByKeywords($keywords);
        $context[self::WORKFORCE_CONTEXT] = $workforces;
        //dd($workforce);
    }
    
    public function getDescription(string $resourceClass): array
    {
        return [
            'workforce' => [
                'property' => null,
                'type' => 'string',
                'required' => false,
                'description' => 'Search worforces with keywords',
                'openapi' => [
                    'example' => '19',
                ],
    
            ]
        ];
    }
}