<?php

namespace App\Filter;

use ApiPlatform\Core\Serializer\Filter\FilterInterface;
use App\Repository\ExperienceRepository;

use Symfony\Component\HttpFoundation\Request;

class ExperienceFilter implements FilterInterface
{
    public const EXPERIENCE_CONTEXT = 'experience_context';

    public function __construct(private ExperienceRepository $experienceRepository)
    {   
    }
    
    public function apply(Request $request, bool $normalization, array $attributes, array &$context)
    {
        $experience = $request->query->get('experience');
        if (!$experience) {
            return;
        }
        $keywords = strtolower($request->get('experience'));
        $keywords = trim($keywords);
        $experiences = $this->experienceRepository->findByKeywords($keywords);
        $context[self::EXPERIENCE_CONTEXT] = $experiences;
    }
    
    public function getDescription(string $resourceClass): array
    {
        return [
            'experience' => [
                'property' => null,
                'type' => 'string',
                'required' => false,
                'description' => 'Search experiences with keywords',
                'openapi' => [
                    'example' => 'lama',
                ],
    
            ]
        ];
    }
}