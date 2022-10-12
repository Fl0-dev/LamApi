<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\Experience;
use App\Utils\Utils;

class ExperienceRepository
{
    /**
     * @return ContractType[]
     */
    public function findAll(): array
    {
        $experiences = [];
        $arrayExperiences = Experience::EXPERIENCES;
        if (is_array($arrayExperiences)) {
            foreach ($arrayExperiences as $value => $experience) {
                $experiences[] = new Experience(
                    Utils::getArrayValue('slug', $experience),
                    Utils::getArrayValue('label', $experience),
                    $value,
                    Utils::getArrayValue('full', $experience),
                    Utils::getArrayValue('duration', $experience),
                    Utils::getArrayValue('minNbMonths', $experience)
                );
            }
        }


        return $experiences;
    }

    public function findByKeywords(string $keywords): ?array
    {
        $experiences = $this->findAll();
        $results = [];

        if (is_array($experiences) && !empty($experiences)) {
            foreach ($experiences as $experience) {
                if (strpos(strtolower($experience->getDuration()), $keywords) !== false) {
                    $results[] = $experience;
                }
            }
        }

        return $results;
    }

    public function find(string $id): ?Experience
    {
        $experiences = $this->findAll();

        foreach ($experiences as $experience) {
            if ($experience->getId() === $id) {
                return $experience;
            }
        }

        return null;
    }
}
