<?php

namespace App\Filter;

use ApiPlatform\Core\Serializer\Filter\FilterInterface;
use App\Repository\ReferencesRepositories\ExperienceRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyInfo\Type;

class ExperienceFilter implements FilterInterface
{
    public const EXPERIENCE_CONTEXT = 'experience_context';
    const EXPERIENCE_QUERY_PARAMETER = 'experience';

    public function __construct(private ExperienceRepository $experienceRepository)
    {   
    }
    
    public function apply(Request $request, bool $normalization, array $attributes, array &$context)
    {
        $experience = $request->query->get(self::EXPERIENCE_QUERY_PARAMETER);
        if (!$experience) {
            return;
        }
        $keywords = strtolower($request->get(self::EXPERIENCE_QUERY_PARAMETER));
        $keywords = trim($keywords);
        $experiences = $this->experienceRepository->findByKeywords($keywords);
        $context[self::EXPERIENCE_CONTEXT] = $experiences;
    }
    
    public function getDescription(string $resourceClass): array
    {
        return [
            self::EXPERIENCE_QUERY_PARAMETER => [
                'property' => null,
                'type' => Type::BUILTIN_TYPE_STRING,
                'required' => false,
                'description' => 'Search experiences with keywords',
                'openapi' => [
                    'example' => 'lama',
                ],
    
            ]
        ];
    }
}