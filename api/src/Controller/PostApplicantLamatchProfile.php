<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\Media\MediaImage;
use App\Entity\Subscriptions\Applicant\ApplicantSubscription;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchProfile;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchSubscription;
use App\Entity\Subscriptions\Applicant\Lamatch\DesiredLocation;
use App\Repository\ApplicantRepositories\ApplicantRepository;
use App\Repository\BadgeRepository;
use App\Repository\ExpertiseFieldRepository;
use App\Repository\JobTitleRepository;
use App\Repository\LocationRepositories\CityRepository;
use App\Repository\LocationRepositories\DepartmentRepository;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantSubscriptionRepository;
use App\Repository\SubscriptionRepositories\DISC\DISCQualityRepository;
use App\Repository\ToolRepository;
use App\Utils\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostApplicantLamatchProfile extends AbstractController
{
    public function __construct(
        private ApplicantRepository $applicantRepository,
        private ApplicantSubscriptionRepository $applicantSubscriptionRepository,
        private JobTitleRepository $jobTitleRepository,
        private BadgeRepository $badgeRepository,
        private DISCQualityRepository $discQualityRepository,
        private CityRepository $cityRepository,
        private DepartmentRepository $departmentRepository,
        private ExpertiseFieldRepository $expertiseFieldRepository,
        private ToolRepository $toolRepository,
    ) {
    }

    public function __invoke(Request $request)
    {
        $applicant = $this->getUser();

        if (!$applicant instanceof Applicant) {
            $applicantId = $request->attributes->get('applicantId');
            $applicant = $this->applicantRepository->find($applicantId);
        }

        $uploadedFile = $request->files->get('file');
        //TODO: gestion slug
        $slugPhoto = $uploadedFile->getClientOriginalName();

        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaImage = new MediaImage();
        $mediaImage->setFile($uploadedFile);

        $mediaImage->setCreatedDate(new \DateTime());
        $mediaImage->setLastModifiedDate(new \DateTime());
        $mediaImage->setSlug($slugPhoto);

        $infoProfile = $request->request->all();
        $applicant->setLinkedin(Utils::getArrayValue('linkedIn', $infoProfile));
        $applicant->setOptin(true);
        $applicantSubscription = new ApplicantSubscription();
        $applicantLamatchSubscription = new ApplicantLamatchSubscription();
        $applicantSubscription->setApplicant($applicant);
        //TODO: à factoriser ->
        $applicantLamatchProfile = new ApplicantLamatchProfile();
        $applicantLamatchProfile->setApplicant($applicant);
        $applicantLamatchProfile->setPhoto($mediaImage);
        $applicantLamatchProfile->setExperience(Utils::getArrayValue('experience', $infoProfile));
        $applicantLamatchProfile->setLevelOfStudy(Utils::getArrayValue('levelOfStudy', $infoProfile));

        $jobTitle = $this->jobTitleRepository->find(Utils::getArrayValue('jobTitle', $infoProfile));
        $applicantLamatchProfile->setJobTitle($jobTitle);

        $applicantLamatchProfile->setIntroduction(Utils::getArrayValue('introduction', $infoProfile));
        $applicantLamatchProfile->setDesiredWorkforce(Utils::getArrayValue('desiredWorkforce', $infoProfile));

        $desiredBadges = Utils::getArrayValue('desiredBadges', $infoProfile);
        if (is_array($desiredBadges)) {
            foreach ($desiredBadges as $badgeId) {
                $badge = $this->badgeRepository->find($badgeId);
                $applicantLamatchProfile->addDesiredBadge($badge);
            }
        }

        $qualities = Utils::getArrayValue('qualities', $infoProfile);
        if (is_array($qualities)) {
            foreach ($qualities as $qualityId) {
                $quality = $this->discQualityRepository->find($qualityId);
                $applicantLamatchProfile->addQuality($quality);
            }
        }

        $tools = Utils::getArrayValue('tools', $infoProfile);
        if (is_array($tools)) {
            foreach ($tools as $toolId) {
                $tool = $this->toolRepository->find($toolId);
                $applicantLamatchProfile->addTool($tool);
            }
        }

        $expertiseFields = Utils::getArrayValue('expertiseFields', $infoProfile);
        if (is_array($expertiseFields)) {
            foreach ($expertiseFields as $expertiseFieldId) {
                $expertiseField = $this->expertiseFieldRepository->find($expertiseFieldId);
                $applicantLamatchProfile->addDesiredExpertiseField($expertiseField);
            }
        }

        $desiredLocation = new DesiredLocation();

        $cities = Utils::getArrayValue('cities', $infoProfile);
        if (is_array($cities)) {
            foreach ($cities as $cityId) {
                $city = $this->cityRepository->find($cityId);
                $desiredLocation->addDesiredCity($city);
            }
        }

        $departments = Utils::getArrayValue('departments', $infoProfile);
        if (is_array($departments)) {
            foreach ($departments as $departmentId) {
                $department = $this->departmentRepository->find($departmentId);
                $desiredLocation->addDesiredDepartment($department);
            }
        }

        $applicantLamatchProfile->setDesiredLocation($desiredLocation);

        $applicantLamatchSubscription->setApplicantLamatchProfile($applicantLamatchProfile);
        $applicantSubscription->setLamatchSubscription($applicantLamatchSubscription);
        $this->applicantSubscriptionRepository->add($applicantSubscription);

        return $applicantLamatchProfile;
    }
}
