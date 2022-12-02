<?php

namespace App\EventSubscriber;

use App\Entity\User\UserPhysical;
use App\Repository\ApplicationRepositories\ApplicationExchangeRepository;
use App\Repository\UserRepositories\UserRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApplicationExchangeSubscriber implements EventSubscriberInterface
{
    public const OPERATION_NAME = "_api_/applications/{id}/exchanges_get_collection";

    public function __construct(
        private ApplicationExchangeRepository $applicationExchangeRepository,
        private UserRepository $userRepository
    ) {
    }

    public function exchangeIsRead(RequestEvent $event): void
    {
        $operationName = $event->getRequest()->attributes->get('_route');

        if ($operationName ===  self::OPERATION_NAME) {
            $userInfo = $event->getRequest()->getSession()->get('_security_main');

            if (is_string($userInfo)) {
                $userInfo = unserialize($userInfo);
                $userMail = $userInfo->getUserIdentifier();
                $user = $this->userRepository->findOneBy(['email' => $userMail]);
            } else {
                throw new \Exception('User not found');
            }

            if ($user instanceof UserPhysical) {
                $response = $event->getRequest()->attributes->get('data')->getIterator();
                $application = $response[0];
                $applicationExchanges = $application->getApplicationExchanges();

                if ($applicationExchanges !== null) {
                    foreach ($applicationExchanges as $applicationExchange) {
                        if ($applicationExchange->getReceiver() == $user->getId()) {
                            $applicationExchange->setIsRead(true);
                            $this->applicationExchangeRepository->add($applicationExchange, true);
                        }
                    }
                }
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'exchangeIsRead',
        ];
    }
}
