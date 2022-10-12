<?php

namespace App\State;

use App\Filter\WorkforceFilter;
use App\Repository\ReferencesRepositories\WorkforceRepository;
use App\Utils\Utils;
use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;

class WorkforceDataProvider implements ProviderInterface
{
    public function __construct(private WorkforceRepository $workforceRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array|object|null
    {
        if ($operation instanceof CollectionOperationInterface) {
            $filters = Utils::getArrayValue('filters', $context);

            if (is_array($filters)) {
                $keyWords = Utils::getArrayValue(WorkforceFilter::WORKFORCE_QUERY_PARAMETER, $filters);

                if (is_string($keyWords)) {
                    return $this->workforceRepository->findByKeyWords($keyWords);
                }
            }

            return $this->workforceRepository->findAll();
        }

        return $this->workforceRepository->find(Utils::getArrayValue('id', $uriVariables));
    }
}
