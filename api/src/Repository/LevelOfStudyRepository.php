<?php

namespace App\Repository;

use App\Entity\Repositories\LevelOfStudy;
use App\Utils\Utils;

class LevelOfStudyRepository
{
    /**
     * Undocumented function
     *
     * @return LevelOfStudy[]
     */
    public function findAll():array
    {
        $levelOfStudies = [];
        $arrayLevelOfStudies = LevelOfStudy::LEVEL_OF_STUDIES;
        if(is_array($arrayLevelOfStudies) && !empty($arrayLevelOfStudies)){
            foreach ($arrayLevelOfStudies as $levelOfStudy) {
                $levelOfStudies[] = new LevelOfStudy(Utils::getArrayValue('slug', $levelOfStudy), Utils::getArrayValue('label', $levelOfStudy));
            }
            return $levelOfStudies;
        }
        return null;
    }
}