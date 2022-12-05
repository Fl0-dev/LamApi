<?php

namespace App\Service;

use App\Entity\Subscriptions\DISC\DISCPersonality;
use App\Repository\ReferencesRepositories\ExperienceRepository;
use App\Repository\ReferencesRepositories\LevelOfStudyRepository;
use App\Repository\ReferencesRepositories\WorkforceRepository;
use Doctrine\Common\Collections\ArrayCollection;

class MatchingService
{
    public function __construct(
        private WorkforceRepository $workforceRepository,
        private LevelOfStudyRepository $levelOfStudyRepository,
        private ExperienceRepository $experienceRepository,
    ) {
    }

    public function getWorkforceMatch(string $companyWorkforceId, ?string $applicantWorkforceId): int
    {
        $workforceMatch = 100;
        $companyWorkforceLevel = $this->workforceRepository->find($companyWorkforceId)->getLevel();

        if ($applicantWorkforceId !== null) {
            $applicantWorkforceLevel = $this->workforceRepository->find($applicantWorkforceId)->getLevel();
        } else {
            return $workforceMatch;
        }

        $workforcesArray = [$applicantWorkforceLevel, $companyWorkforceLevel];
        rsort($workforcesArray);

        match ($workforcesArray[0] - $workforcesArray[1]) {
            0 => $workforceMatch = 100,
            1, 2 => $workforceMatch = 75,
            3, 4 => $workforceMatch = 50,
            5, 6, 7, 8, 9, 10 => $workforceMatch = 25,
        };

        return $workforceMatch;
    }

    public function getLevelOfStudyMatch(string $companyDesiredLevelOfStudyId, ?string $applicantLevelOfStudyId): int
    {
        $levelOfStudyMatch = 100;
        $companyDesiredLevelOfStudyLevel =
            $this->levelOfStudyRepository->find($companyDesiredLevelOfStudyId)->getLevel();
        $applicantLevelOfStudyLevel = 0;

        if ($applicantLevelOfStudyId !== null) {
            $applicantLevelOfStudyLevel = $this->levelOfStudyRepository->find($applicantLevelOfStudyId)->getLevel();
        }

        $levelOfStudiesArray = [$applicantLevelOfStudyLevel, $companyDesiredLevelOfStudyLevel];
        rsort($levelOfStudiesArray);

        match ($levelOfStudiesArray[0] - $levelOfStudiesArray[1]) {
            0 => $levelOfStudyMatch = 100,
            1, 2 => $levelOfStudyMatch = 80,
            3, 4 => $levelOfStudyMatch = 25,
            5, 6, 7, 8, 9, 10 => $levelOfStudyMatch = 0,
        };

        if ($applicantLevelOfStudyLevel === 0) {
            $levelOfStudyMatch = 50;
        }

        return $levelOfStudyMatch;
    }

    public function getExperienceMatch(string $companyDesiredExperienceId, ?string $applicantExperienceId): int
    {
        $experienceMatch = 100;
        $companyDesiredExperienceLevel = $this->experienceRepository->find($companyDesiredExperienceId)->getValue();
        $applicantExperienceLevel = 0;

        if ($applicantExperienceId !== null) {
            $applicantExperienceLevel = $this->experienceRepository->find($applicantExperienceId)->getValue();
        }

        if ($applicantExperienceLevel < $companyDesiredExperienceLevel) {
            $experienceMatch = 0;
        }

        return $experienceMatch;
    }

    public function getJobTypeMatch($companyJobTypes, $applicantJobTypes)
    {
        $jobTitleMatch = 100;

        if (!$applicantJobTypes) {
            return 0;
        }

        foreach ($companyJobTypes as $companyJobType) {
            if ($applicantJobTypes->contains($companyJobType)) {
                return $jobTitleMatch;
            }
        }

        return 0;
    }

    public function getJobTitleMatch($companyJobTitle, $applicantJobTitle)
    {
        $jobTitleMatch = 100;

        if (!$applicantJobTitle || $applicantJobTitle !== $companyJobTitle) {
            return 0;
        }

        return $jobTitleMatch;
    }

    public function getBadgesMatch($companyBadges, $applicantBadges)
    {
        if ($applicantBadges->isEmpty() || $applicantBadges === null) {
            return 100;
        }

        $badgesMatch = 0;
        foreach ($applicantBadges as $applicantBadge) {
            foreach ($companyBadges as $companyBadge) {
                if ($applicantBadge->getId() === $companyBadge->getId()) {
                    $badgesMatch++;
                }
            }
        }
        $badgesMatch = $badgesMatch * 100 / count($applicantBadges);

        return (int)$badgesMatch;
    }

    public function getToolsMatch($companyTools, $applicantTools)
    {
        $toolsMatch = 0;
        foreach ($companyTools as $companyTool) {
            foreach ($applicantTools as $applicantTool) {
                if ($companyTool->getId() === $applicantTool->getId()) {
                    $toolsMatch++;
                }
            }
        }

        $toolsMatch = $toolsMatch * 100 / count($companyTools);

        return (int)$toolsMatch;
    }

    public function getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields)
    {
        $expertiseFieldsMatch = 100;

        if ($applicantExpertiseFields === null || $applicantExpertiseFields->isEmpty()) {
            return $expertiseFieldsMatch;
        }

        foreach ($applicantExpertiseFields as $applicantExpertiseField) {
            foreach ($companyExpertiseFields as $companyExpertiseField) {
                if ($applicantExpertiseField->getId() === $companyExpertiseField->getId()) {
                    return $expertiseFieldsMatch;
                }
            }
        }

        return 0;
    }

    public function getLocationMatch($companyEntityCities, $applicantLocation): int
    {
        $cityMatch = 0;
        $departmentMatch = 0;
        $applicantDesiredCities = $applicantLocation->getDesiredCities();
        $numberOfapplicantDesiredCities = count($applicantDesiredCities);
        $applicantDesiredDepartments = $applicantLocation->getDesiredDepartments();
        $numberOfapplicantDesiredDepartments = count($applicantDesiredDepartments);
        $companyEntityDepartments = new ArrayCollection();

        foreach ($companyEntityCities as $companyEntityCity) {
            if (!$companyEntityDepartments->contains($companyEntityCity->getDepartment())) {
                $companyEntityDepartments->add($companyEntityCity->getDepartment());
            }
        }

        foreach ($companyEntityCities as $companyEntityCity) {
            if ($applicantDesiredCities->contains($companyEntityCity)) {
                $cityMatch += 1;
            }
        }

        foreach ($companyEntityDepartments as $companyEntityDepartment) {
            if ($applicantDesiredDepartments->contains($companyEntityDepartment)) {
                $departmentMatch += 1;
            }
        }

        if ($numberOfapplicantDesiredCities > 0) {
            $cityMatch = $cityMatch * 100 / $numberOfapplicantDesiredCities;
        }

        if ($numberOfapplicantDesiredDepartments > 0) {
            $departmentMatch = $departmentMatch * 100 / $numberOfapplicantDesiredDepartments;
        }

        return ($cityMatch + $departmentMatch) / 2;
    }

    public function getPersonalityMatch(DISCPersonality $companyPersonality, $applicantQualities): int
    {
        $personalityMatch = 0;


        foreach ($applicantQualities as $applicantQuality) {
            if ($applicantQuality->getPersonality()->getId() === $companyPersonality->getId()) {
                $personalityMatch++;
            }
        }

        $personalityMatch = $personalityMatch * 100 / count($applicantQualities);

        return $personalityMatch;
    }

    public function getMatchingPercentage($matchResults): int
    {
        $matchingPercentage = 0;

        foreach ($matchResults as $matchResult) {
            $matchingPercentage += $matchResult;
        }

        $matchingPercentage = (int) ($matchingPercentage / count($matchResults));

        return $matchingPercentage;
    }
}
