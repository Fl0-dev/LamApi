<?php

namespace App\EventSubscriber;

use App\Entity\Badge;
use App\Entity\Company\CompanyGroup;
use App\Entity\JobType;
use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Entity\Research\CompanyResearch;
use App\Entity\Tool;
use App\Repository\BadgeRepository;
use App\Repository\CompanyRepositories\CompanyGroupRepository;
use App\Repository\JobTypeRepository;
use App\Repository\LocationRepositories\CityRepository;
use App\Repository\LocationRepositories\DepartmentRepository;
use App\Repository\ReferencesRepositories\WorkforceRepository;
use App\Repository\ResearchRepositories\CompanyResearchRepository;
use App\Repository\ToolRepository;
use App\Utils\Utils;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class CompanyResearchSubscriber implements EventSubscriberInterface
{
    const OPERATION_NAME = "api_company_groups_getCompanyGroupTeaser_collection";   

    public function  __construct(
        private CityRepository $cityRepository,
        private DepartmentRepository $departmentRepository,
        private JobTypeRepository $jobTypeRepository,
        private ToolRepository $toolRepository,
        private BadgeRepository $badgeRepository,
        private CompanyGroupRepository $companyGroupRepository,
        private WorkforceRepository $workforceRepository,
        private CompanyResearchRepository $companyResearchRepository,
        ) {}
        
    public function saveCompanyResearch(ResponseEvent $event): void
    {
        //récupère l'opération en cours
        $operationName = $event->getRequest()->attributes->get('_route');

        if ($operationName ===  self::OPERATION_NAME) {
            $companyResearch = new CompanyResearch();

            //TODO : récupération de l'applicant si applicant

            //récupère les filtres
            $filters = $event->getRequest()->query->all();

            //jobType
            $jobTypes = Utils::getArrayValue('jobTypes', $filters);

            if ($jobTypes !== null && is_array($jobTypes)) {

                foreach ($jobTypes as $key => $value) {
                    $jobType = $this->jobTypeRepository->findOneBy(['id' => $value]);

                    if ($jobType instanceof JobType) {
                        $companyResearch->addJobType($jobType);
                    }
                }
            }

            //city
            $cities = Utils::getArrayValue('companyEntities_companyEntityOffices_address_city', $filters);

            if ($cities !== null && is_array($cities)) {

                foreach ($cities as $key => $value) {
                    $city = $this->cityRepository->findOneBy(['id' => $value]);

                    if ($city instanceof City) {
                        $companyResearch->addCity($city);
                    }
                }
            }

            //department
            $departments = Utils::getArrayValue('companyEntities_companyEntityOffices_address_city_department', $filters);

            if ($departments !== null && is_array($departments)) {

                foreach ($departments as $key => $value) {
                    $department = $this->departmentRepository->findOneBy(['id' => $value]);

                    if ($department instanceof Department) {
                        $companyResearch->addDepartment($department);
                    }
                }
            }

            //tool
            $tools = Utils::getArrayValue('profile_tools', $filters);

            if ($tools !== null && is_array($tools)) {

                foreach ($tools as $key => $value) {
                    $tool = $this->toolRepository->findOneBy(['id' => $value]);

                    if ($tool instanceof Tool) {
                        $companyResearch->addTool($tool);
                    }
                }
            }

            //badge
            $badges = Utils::getArrayValue('badges', $filters);

            if ($badges !== null && is_array($badges)) {

                foreach ($badges as $key => $value) {
                    $badge = $this->badgeRepository->findOneBy(['id' => $value]);

                    if ($badge instanceof Badge) {
                        $companyResearch->addBadge($badge);
                    }
                }
            }

            //workforce
            $workforces = Utils::getArrayValue('profile_workforce', $filters);

            if ($workforces !== null && is_array($workforces)) {

                foreach ($workforces as $key => $value) {
                    if ($this->workforceRepository->find($value) !== null) {
                        $companyResearch->addWorkforce($value);
                    }
                }
            }

            //companyGroupName
            $companyName = Utils::getArrayValue('name', $filters);

            if ($companyName !== null) {
                $companyResearch->setCompanyName($companyName);
            }

            //récupère les résultats
            $response = $event->getResponse()->getContent();

            if ($response) {
                $response = json_decode($response, true);

                foreach (Utils::getArrayValue('hydra:member', $response) as $key => $value) {
                    $companyGroup = $this->companyGroupRepository->findOneBy(['id' => $value['id']]);

                    if ($companyGroup instanceof CompanyGroup) {
                        $companyResearch->addCompanyResult($companyGroup);
                    }
                    
                    $companyResearch->setCreatedDate(new \DateTime());
                }
            }
            
            $this->companyResearchRepository->add($companyResearch, true);
        }
        
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'saveCompanyResearch',
        ];
    }
}
