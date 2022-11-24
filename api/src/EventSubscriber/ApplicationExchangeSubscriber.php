<?php

namespace App\EventSubscriber;

use App\Entity\User\UserPhysical;
use App\Repository\ApplicationRepositories\ApplicationExchangeRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApplicationExchangeSubscriber implements EventSubscriberInterface
{
    public const OPERATION_NAME = "_api_/applications/{id}/exchanges_get_collection";

    public function __construct(private ApplicationExchangeRepository $applicationExchangeRepository)
    {
    }

    public function exchangeIsRead(RequestEvent $event): void
    {
        $operationName = $event->getRequest()->attributes->get('_route');
        if ($operationName ===  self::OPERATION_NAME) {
            $user = $event->getRequest()->getSession()->get('_security_main');

            if (is_string($user)) {
                $user = unserialize($user);
            } else {
                throw new \Exception('User not found');
            }

            if ($user instanceof UserPhysical) {
                $response = $event->getRequest()->attributes->get('data')->getIterator();
                $application = $response[0];
                $applicationExchanges = $application->getApplicationExchanges();

                if ($applicationExchanges !== null) {
                    foreach ($applicationExchanges as $applicationExchange) {
                        if ($applicationExchange->getReceiver() === $user) {
                            $applicationExchange->setIsRead(true);
                            $this->applicationExchangeRepository->save($applicationExchange);
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
