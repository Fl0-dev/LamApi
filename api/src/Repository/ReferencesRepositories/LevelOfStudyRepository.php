<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\LevelOfStudy;
use App\Utils\Utils;

class LevelOfStudyRepository
{
    /**
     * @return LevelOfStudy[]
     */
    public function findAll(): array
    {
        $levelOfStudies = [];
        $arrayLevelOfStudies = LevelOfStudy::LEVEL_OF_STUDIES;

        foreach ($arrayLevelOfStudies as $levelOfStudy) {
            $levelOfStudies[] = new LevelOfStudy(Utils::getArrayValue('slug', $levelOfStudy), Utils::getArrayValue('label', $levelOfStudy));
        }

        return $levelOfStudies;
    }
}
