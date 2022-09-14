<?php

namespace App\EventSubscriber;

use App\Entity\JobTitle;
use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Entity\Offer\Offer;
use App\Entity\Research\OfferResearch;
use App\Repository\JobTitleRepository;
use App\Repository\LocationRepositories\CityRepository;
use App\Repository\LocationRepositories\DepartmentRepository;
use App\Repository\OfferRepositories\OfferRepository;
use App\Repository\ReferencesRepositories\ContractTypeRepository;
use App\Repository\ReferencesRepositories\ExperienceRepository;
use App\Repository\ResearchRepositories\OfferResearchRepository;
use App\Utils\Utils;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class OfferSubscriber implements EventSubscriberInterface
{
    const OPERATION_NAME = "api_offers_getOfferTeasers_collection";

    public function __construct(
        private OfferRepository $offerRepository,
        private JobTitleRepository $jobTitleRepository,
        private CityRepository $cityRepository,
        private DepartmentRepository $departmentRepository,
        private OfferResearchRepository $offerResearchRepository,
        private ExperienceRepository $experienceRepository,
        private ContractTypeRepository $contractTypeRepository,
        ) {}
    

    public function saveOfferResearch(ResponseEvent $event): void
    {
        //récupère l'opération en cours
        $operationName = $event->getRequest()->attributes->get('_route');

        if ($operationName ===  self::OPERATION_NAME) {
            $offerResearch = new OfferResearch();

            //TODO : récupération de l'applicant si applicant

            //récupère les filtres
            $filters = $event->getRequest()->query->all();
            // dd($filters);

            //jobTitle
            $jobTitles = Utils::getArrayValue('jobTitle', $filters);

            if ($jobTitles !== null && is_array($jobTitles)) {
                foreach ($jobTitles as $key => $value) {

                    $jobTitle = $this->jobTitleRepository->findOneBy(['id' => $value]);

                    if ($jobTitle instanceof JobTitle) {
                        $offerResearch->addJobTitle($jobTitle);
                    }
                }
            }
            
            //city
            $cities = Utils::getArrayValue('companyEntityOffice_address_city', $filters);

            if ($cities !== null && is_array($cities)) {
                foreach ($cities as $key => $value) {
                    $city = $this->cityRepository->findOneBy(['id' => $value]);

                    if ($city instanceof City) {
                        $offerResearch->addCity($city);
                    }
                }
            }

            //department
            $departments = Utils::getArrayValue('companyEntityOffice_address_city_department', $filters);
            
            if ($departments !== null && is_array($departments)) {

                foreach ($departments as $key => $value) {
                    $department = $this->departmentRepository->findOneBy(['id' => $value]);
                    
                    if ($department instanceof Department) {
                        $offerResearch->addDepartment($department);
                    }
                }
            }

            //experience
            $experiences = Utils::getArrayValue('experience', $filters);

            if ($experiences !== null && is_array($experiences)) {

                foreach ($experiences as $key => $value) {
                    if ($this->experienceRepository->find($value) !== null) {
                        $offerResearch->addExperience($value);
                    }
                }
            }

            //contractType
            $contractTypes = Utils::getArrayValue('contractType', $filters);

            if ($contractTypes !== null && is_array($contractTypes)) {

                foreach ($contractTypes as $key => $value) {
                    if ($this->contractTypeRepository->find($value) !== null) {
                        $offerResearch->addContractType($value);
                    }
                }
            }

            //récupère les résultats
            $response = $event->getResponse()->getContent();

            if ($response) {
                
                $offers = json_decode($response, true);
                
                foreach (Utils::getArrayValue('hydra:member', $offers) as $offerTeaser) {
                    $offer = $this->offerRepository->findOneBy(['id' => Utils::getArrayValue('id', $offerTeaser)]);
                    
                    if ($offer instanceof Offer) {
                        $offerResearch->addOfferResult($offer);
                    }
                    
                    $offerResearch->setCreatedDate(new \DateTime());
                }
            }
            
            $this->offerResearchRepository->add($offerResearch, true);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'saveOfferResearch',
        ];
    }
}
