<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\Badge;
use App\Entity\ExpertiseField;
use App\Entity\JobTitle;
use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Entity\Media\MediaImage;
use App\Entity\References\Experience;
use App\Entity\References\Workforce;
use App\Entity\Subscriptions\Applicant\ApplicantSubscription;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchProfile;
use App\Entity\Subscriptions\Applicant\Lamatch\ApplicantLamatchSubscription;
use App\Entity\Subscriptions\Applicant\Lamatch\DesiredLocation;
use App\Entity\Subscriptions\DISC\DISCQuality;
use App\Entity\Tool;
use App\Repository\BadgeRepository;
use App\Repository\ExpertiseFieldRepository;
use App\Repository\JobTitleRepository;
use App\Repository\LocationRepositories\CityRepository;
use App\Repository\LocationRepositories\DepartmentRepository;
use App\Repository\ReferencesRepositories\ExperienceRepository;
use App\Repository\ReferencesRepositories\LevelOfStudyRepository;
use App\Repository\ReferencesRepositories\WorkforceRepository;
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
        private ApplicantSubscriptionRepository $applicantSubscriptionRepository,
        private JobTitleRepository $jobTitleRepository,
        private BadgeRepository $badgeRepository,
        private DISCQualityRepository $discQualityRepository,
        private CityRepository $cityRepository,
        private DepartmentRepository $departmentRepository,
        private ExpertiseFieldRepository $expertiseFieldRepository,
        private ToolRepository $toolRepository,
        private ExperienceRepository $experienceRepository,
        private LevelOfStudyRepository $levelOfStudyRepository,
        private WorkforceRepository $workforceRepository,
    ) {
    }

    public function __invoke(Request $request)
    {
        $applicant = $this->getUser();

        if (!$applicant instanceof Applicant) {
            throw new BadRequestHttpException('Applicant not found');
        }

        $uploadedFile = $request->files->get('file');

        if (
            $uploadedFile->guessExtension() !== 'jpg' &&
            $uploadedFile->guessExtension() !== 'jpeg' &&
            $uploadedFile->guessExtension() !== 'png'
        ) {
            throw new BadRequestHttpException('File must be a jpg or png');
        }

        $slugPhoto = $uploadedFile->getClientOriginalName();

        if (!Utils::isSlug($slugPhoto)) {
            throw new BadRequestHttpException('File name must not contain special characters');
        }

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
        // dd($mediaImage);
        $experienceId = Utils::getArrayValue('experience', $infoProfile);
        $experience = $this->experienceRepository->find($experienceId);

        if ($experience instanceof Experience) {
            $applicantLamatchProfile->setExperience($experienceId);
        }

        $levelOfStudyId = Utils::getArrayValue('levelOfStudy', $infoProfile);
        $levelOfStudy = $this->levelOfStudyRepository->find($levelOfStudyId);

        if ($levelOfStudy instanceof Experience) {
            $applicantLamatchProfile->setLevelOfStudy($levelOfStudyId);
        }

        $jobTitle = $this->jobTitleRepository->find(Utils::getArrayValue('jobTitle', $infoProfile));

        if ($jobTitle instanceof JobTitle) {
            $applicantLamatchProfile->setJobTitle($jobTitle);
        }

        $desiredWorkforceId = Utils::getArrayValue('desiredWorkforce', $infoProfile);
        $desiredWorkforce = $this->workforceRepository->find($desiredWorkforceId);

        if ($desiredWorkforce instanceof Workforce) {
            $applicantLamatchProfile->setDesiredWorkforce($desiredWorkforceId);
        }

        $applicantLamatchProfile->setIntroduction(Utils::getArrayValue('introduction', $infoProfile));

        $desiredBadges = Utils::getArrayValue('desiredBadges', $infoProfile);

        if (is_array($desiredBadges)) {
            foreach ($desiredBadges as $badgeId) {
                $badge = $this->badgeRepository->find($badgeId);

                if ($badge instanceof Badge) {
                    $applicantLamatchProfile->addDesiredBadge($badge);
                }
            }
        }

        $qualities = Utils::getArrayValue('qualities', $infoProfile);

        if (is_array($qualities)) {
            foreach ($qualities as $qualityId) {
                $quality = $this->discQualityRepository->find($qualityId);

                if ($quality instanceof DISCQuality) {
                    $applicantLamatchProfile->addQuality($quality);
                }
            }
        }

        $tools = Utils::getArrayValue('tools', $infoProfile);

        if (is_array($tools)) {
            foreach ($tools as $toolId) {
                $tool = $this->toolRepository->find($toolId);

                if ($tool instanceof Tool) {
                    $applicantLamatchProfile->addTool($tool);
                }
            }
        }

        $expertiseFields = Utils::getArrayValue('desiredExpertiseFields', $infoProfile);

        if (is_array($expertiseFields)) {
            foreach ($expertiseFields as $expertiseFieldId) {
                $expertiseField = $this->expertiseFieldRepository->find($expertiseFieldId);

                if ($expertiseField instanceof ExpertiseField) {
                    $applicantLamatchProfile->addDesiredExpertiseField($expertiseField);
                }
            }
        }

        $desiredLocation = new DesiredLocation();

        $cities = Utils::getArrayValue('desiredCities', $infoProfile);

        if (is_array($cities)) {
            foreach ($cities as $cityId) {
                $city = $this->cityRepository->find($cityId);

                if ($city instanceof City) {
                    $desiredLocation->addDesiredCity($city);
                }
            }
        }

        $departments = Utils::getArrayValue('desiredDepartments', $infoProfile);

        if (is_array($departments)) {
            foreach ($departments as $departmentId) {
                $department = $this->departmentRepository->find($departmentId);

                if ($department instanceof Department) {
                    $desiredLocation->addDesiredDepartment($department);
                }
            }
        }

        $applicantLamatchProfile->setDesiredLocation($desiredLocation);

        $applicantLamatchSubscription->setApplicantLamatchProfile($applicantLamatchProfile);
        $applicantSubscription->setLamatchSubscription($applicantLamatchSubscription);
        $this->applicantSubscriptionRepository->add($applicantSubscription, true);

        return $applicantLamatchProfile;
    }
}
