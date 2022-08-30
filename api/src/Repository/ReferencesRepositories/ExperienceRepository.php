<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\Experience;
use App\Utils\Utils;

class ExperienceRepository
{
    /**
     * Undocumented function
     *
     * @return ContractType[]
     */
    public function findAll(): array
    {
        $experiences = [];
        $arrayExperiences = Experience::EXPERIENCES;

        foreach ($arrayExperiences as $value => $experience) {
            $experiences[] = new Experience(
                $value,
                Utils::getArrayValue('full', $experience),
                Utils::getArrayValue('label', $experience),
                Utils::getArrayValue('duration', $experience),
                Utils::getArrayValue('minNbMonths', $experience)
            );
        }

        return $experiences;
    }

    public function findByKeywords(string $keywords): ?array
    {
        $experiences = $this->findAll();
        $results = [];

        if (is_array($experiences) && !empty($experiences)) {

            foreach ($experiences as $experience) {
                if (strpos(strtolower($experience->getFull()), $keywords) !== false) {
                    $results[] = $experience;
                }
            }
        }

        return $results;
    }
}
