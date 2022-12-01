<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\Application\Application;
use App\Entity\Application\ApplicationExchange;
use App\Entity\Company\CompanyEntityOffice;
use App\Entity\Offer\Offer;
use App\Entity\User\Employer;
use App\Entity\User\UserPhysical;
use App\Repository\ApplicationRepositories\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PostApplicationExchangeByApplicationId extends AbstractController
{
    public function __construct(
        private ApplicationRepository $applicationRepository,
    ) {
    }

    public function __invoke(Request $request): ?ApplicationExchange
    {
        $currentPhysicalUser = $this->getUser();

        if (!$currentPhysicalUser instanceof UserPhysical) {
            throw new \Exception('PhysicalUser not found');
        }

        $applicationId = $request->attributes->get('applicationId');
        $application = $this->applicationRepository->find($applicationId);

        if (!$application instanceof Application) {
            throw new \Exception('Application not found');
        }

        $applicationExchange = $request->get('data');

        if (!$applicationExchange instanceof ApplicationExchange) {
            throw new \Exception('ApplicationExchange not found');
        }

        $applicationExchange->setApplication($application);
        $admins = new ArrayCollection();

        if ($application->getCompanyEntityOffice() instanceof CompanyEntityOffice) {
            $admins = $application->getCompanyEntityOffice()->getCompanyEntity()->getAdmins();

            if ($admins->isEmpty()) {
                throw new \Exception('No admin found');
            }
        }

        if (($currentPhysicalUser instanceof Applicant && $application->getApplicant() !== $currentPhysicalUser) ||
            ($currentPhysicalUser instanceof Employer && !$admins->contains($currentPhysicalUser))
        ) {
            throw new \Exception('You are not allowed to send an exchange for this application');
        }

        if ($application->isIsSpontaneous() === false && $application->getOffer() instanceof Offer) {
            $applicationExchange->setTransmitter($currentPhysicalUser);

            if ($currentPhysicalUser instanceof Applicant) {
                $applicationExchange->setReceiver($application->getOffer()->getAuthor()->getId());
            } else {
                $applicationExchange->setReceiver($application->getApplicant())->getId();
            }
        }

        if ($application->isIsSpontaneous() === true) {
            $applicationExchange->setTransmitter($currentPhysicalUser);

            if ($currentPhysicalUser instanceof Applicant) {
                $applicationExchange->setReceiver($application->getCompanyEntityOffice()->getCompanyEntity()->getId());
            } else {
                $applicationExchange->setReceiver($application->getApplicant()->getId());
            }
        } else {
            throw new \Exception('Application is not a valid application');
        }
        return $applicationExchange;
    }
}
