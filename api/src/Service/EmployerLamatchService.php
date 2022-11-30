<?php

namespace App\Service;

use App\Entity\References\SubscriptionStatus;
use App\Entity\Subscriptions\Employer\Lamatch\ApplicantResult;
use App\Entity\Subscriptions\Employer\Lamatch\EmployerLamatch;
use App\Entity\Subscriptions\Employer\Lamatch\EmployerLamatchProfile;
use App\Repository\ReferencesRepositories\ExperienceRepository;
use App\Repository\ReferencesRepositories\LevelOfStudyRepository;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantLamatchSubscriptionRepository;
use App\Repository\SubscriptionRepositories\Employer\ApplicantResultRepository;
use Doctrine\Common\Collections\ArrayCollection;

class EmployerLamatchService
{
    public function __construct(
        private ApplicantLamatchSubscriptionRepository $applicantLamatchSubscriptionRepository,
        private MatchingService $matchingService,
        private ApplicantResultRepository $applicantResultRepository,
        private LevelOfStudyRepository $levelOfStudyRepository,
        private ExperienceRepository $experienceRepository,
    ) {
    }

    public function getApplicantResults(
        EmployerLamatchProfile $employerLamatchProfile,
        EmployerLamatch $employerLamatch,
    ): array {
        $status = (new SubscriptionStatus(SubscriptionStatus::ACTIVE, 'Actif'))->getId();
        $applicantResults = new ArrayCollection();
        $matchResults = [];

        $allApplicantLamatchSubscriptions = $this->applicantLamatchSubscriptionRepository->findBy([
            'status' => $status,
        ]);

        $allApplicantLamatchProfiles = new ArrayCollection();

        if (is_array($allApplicantLamatchSubscriptions)) {
            foreach ($allApplicantLamatchSubscriptions as $applicantLamatchSubscription) {
                $allApplicantLamatchProfiles->add($applicantLamatchSubscription->getApplicantLamatchProfile());
            }
        }

        if ($allApplicantLamatchProfiles instanceof ArrayCollection) {
            foreach ($allApplicantLamatchProfiles as $applicantLamatchProfile) {
                //Matching with Workforce
                $companyWorkforceId = $employerLamatchProfile->getCompanyProfile()->getWorkforce();
                $applicantWorkforceId = $applicantLamatchProfile->getDesiredWorkforce();
                $workforceMatch = $this->matchingService->getWorkforceMatch($companyWorkforceId, $applicantWorkforceId);
                $matchResults['workforce'] = $workforceMatch;

                //Matching with LevelOfStudy
                $companyLevelOfStudyId = $employerLamatchProfile->getLevelOfStudy();
                $applicantLevelOfStudyId = $applicantLamatchProfile->getLevelOfStudy();
                $levelOfStudyMatch =
                    $this->matchingService->getLevelOfStudyMatch($companyLevelOfStudyId, $applicantLevelOfStudyId);
                $matchResults['levelOfStudy'] = $levelOfStudyMatch;

                //Matching with Experience
                $companyExperienceId = $employerLamatchProfile->getExperience();
                $applicantExperienceId = $applicantLamatchProfile->getExperience();
                $experienceMatch =
                    $this->matchingService->getExperienceMatch($companyExperienceId, $applicantExperienceId);
                $matchResults['experience'] = $experienceMatch;

                //Matching with JobTitle
                $companyDesiredJobtitle = $employerLamatchProfile->getJobtitle();
                $applicantJobtitle = $applicantLamatchProfile->getJobtitle();
                $jobtitleMatch = $this->matchingService->getJobtitleMatch($companyDesiredJobtitle, $applicantJobtitle);
                $matchResults['jobtitle'] = $jobtitleMatch;

                //Matching with Badges
                $companyBadges = $employerLamatchProfile->getCompanyProfile()->getBadges();
                $applicantBadges = $applicantLamatchProfile->getDesiredBadges();
                $badgesMatch = $this->matchingService->getBadgesMatch($companyBadges, $applicantBadges);
                $matchResults['badges'] = $badgesMatch;

                //Matching with Tools
                $companyTools = $employerLamatchProfile->getCompanyProfile()->getTools();
                $applicantTools = $applicantLamatchProfile->getTools();
                $toolsMatch = $this->matchingService->getToolsMatch($companyTools, $applicantTools);
                $matchResults['tools'] = $toolsMatch;

                //Matching with ExpertiseFields
                $companyExpertiseFields = $employerLamatchProfile->getCompanyProfile()->getExpertiseFields();
                $applicantExpertiseFields = $applicantLamatchProfile->getDesiredExpertiseFields();
                $expertiseFieldsMatch =
                    $this->matchingService->getExpertiseFieldsMatch($companyExpertiseFields, $applicantExpertiseFields);
                $matchResults['expertiseFields'] = $expertiseFieldsMatch;

                //Matching with Location
                $applicantLocation = $applicantLamatchProfile->getDesiredLocation();
                $companyLocation = new ArrayCollection();
                $companyLocation->add($employerLamatchProfile->getCompanyEntityOffice()->getAddress()->getCityObject());
                $locationMatch = $this->matchingService->getLocationMatch($companyLocation, $applicantLocation);
                $matchResults['location'] = $locationMatch;

                //Matching with Personality
                $companyPersonality = $employerLamatchProfile->getPersonality();
                $applicantQualities = $applicantLamatchProfile->getQualities();
                $personalityMatch =
                    $this->matchingService->getPersonalityMatch($companyPersonality, $applicantQualities);
                $matchResults['personality'] = $personalityMatch;

                $matchingPercentage = $this->matchingService->getMatchingPercentage($matchResults);

                $applicantResult = new ApplicantResult();
                $applicantResult->setApplicant($applicantLamatchProfile->getApplicant());
                $applicantResult->setMatchingPercentage($matchingPercentage);
                $applicantResult->setEmployerLamatch($employerLamatch);
                $applicantResult->setApplicantLamatchProfile($applicantLamatchProfile);

                $this->applicantResultRepository->add($applicantResult, true);

                $applicantResults->add($applicantResult);
            }
        }

        $applicantResults = $this->getApplicantResultsForDisplay($applicantResults, $employerLamatchProfile);

        return $applicantResults;
    }

    public function getApplicantResultsForDisplay(
        ArrayCollection $applicantResults,
        EmployerLamatchProfile $employerLamatchProfile
    ): array {
        $applicantResultsForDisplay = [];

        foreach ($applicantResults as $applicantResult) {
            $levelOfStudyLabel = $this->levelOfStudyRepository->getLevelOfStudyLabel(
                $applicantResult->getApplicantLamatchProfile()->getLevelOfStudy()
            );
            $experienceLabel = $this->experienceRepository->getExperienceLabel(
                $applicantResult->getApplicantLamatchProfile()->getExperience()
            );
            $applicantPhoto = $applicantResult->getApplicantLamatchProfile()->getPhoto();
            $photoFilePath = $applicantPhoto ? $applicantPhoto->getFilePath() : 'default.png';

            $applicantResultsForDisplay[] = [
                'applicantResultId' => $applicantResult->getId(),
                'applicantId' => $applicantResult->getApplicant()->getId(),
                'name' => $applicantResult->getApplicant()->getFirstName() . ' ' .
                    $applicantResult->getApplicant()->getLastName(),
                'matchingPercentage' => $applicantResult->getMatchingPercentage(),
                'jobTitle' => $applicantResult->getApplicantLamatchProfile()->getJobTitle()->getLabel(),
                'levelOfStudy' => $levelOfStudyLabel,
                'experience' => $experienceLabel,
                'introduction' => $applicantResult->getApplicantLamatchProfile()->getIntroduction(),
                'photo' => $photoFilePath,
            ];
        }

        $levelOfStudyLabelOfCompanyProfile = $this->levelOfStudyRepository->getLevelOfStudyLabel(
            $employerLamatchProfile->getLevelOfStudy()
        );

        $experienceLabelOfCompanyProfile = $this->experienceRepository->getExperienceLabel(
            $employerLamatchProfile->getExperience()
        );

        $applicantResultsForDisplay[]['EmployerLamatchProfile'] = [
            'id' => $employerLamatchProfile->getId(),
            'name' => $employerLamatchProfile->getLabel(),
            'jobTitle' => $employerLamatchProfile->getJobTitle()->getLabel(),
            'experience' => $experienceLabelOfCompanyProfile,
            'levelOfStudy' => $levelOfStudyLabelOfCompanyProfile,
            'personality' => $employerLamatchProfile->getPersonality()->getLabel(),
            'office' => $employerLamatchProfile->getCompanyEntityOffice()->getName(),
        ];

        return $applicantResultsForDisplay;
    }
}
