<?php

namespace App\Controller;

use App\Entity\Applicant\Applicant;
use App\Entity\Application\Application;
use App\Entity\Application\ApplicationExchange;
use App\Entity\Offer\Offer;
use App\Entity\User\Employer;
use App\Entity\User\UserPhysical;
use App\Repository\ApplicationRepositories\ApplicationRepository;
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
        $physicalUser = $this->getUser();
        if (!$physicalUser instanceof UserPhysical) {
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

        if ($physicalUser instanceof Applicant && $application->getApplicant() === $physicalUser) {
            $applicationExchange->setTransmitter($physicalUser);
            $applicationExchange->setReceiver($application->getOffer()->getAuthor());
        } elseif ($physicalUser instanceof Employer) {
            if ($application->getOffer() instanceof Offer && $application->getOffer()->getAuthor() === $physicalUser) {
                $applicationExchange->setTransmitter($physicalUser);
                $applicationExchange->setReceiver($application->getApplicant());
            } elseif ($application->getCompanyEntityOffice()->getCompanyEntity()->getAdmins()
                ->contains($physicalUser)) {
                $applicationExchange->setTransmitter($physicalUser);
                $applicationExchange->setReceiver($application->getApplicant());
            } else {
                throw new \Exception('You are not allowed to send messages to this applicant');
            }
        }

        return $applicationExchange;
    }
}
