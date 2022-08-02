<?php 

namespace App\Repository;

use App\Entity\Repositories\Experience;
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
        if (is_array($arrayExperiences) && !empty($arrayExperiences)) {
            foreach ($arrayExperiences as $value => $experience) {
                $experiences[] = new Experience(
                    $value, 
                    Utils::getArrayValue('full', $experience),
                    Utils::getArrayValue('label', $experience),
                    Utils::getArrayValue('duration', $experience),
                    Utils::getArrayValue('minNbMonths', $experience));
            }
            return $experiences;
        }
        return null;
    }
}