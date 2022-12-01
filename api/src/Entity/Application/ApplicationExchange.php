<?php

namespace App\Entity\Application;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\PostApplicationExchangeByApplicationId;
use App\Entity\Applicant\Applicant;
use App\Entity\User\UserPhysical;
use App\Repository\ApplicationRepositories\ApplicationExchangeRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\UuidV6;

#[ApiResource(
    operations: [
        new Post(
            security: "is_granted('ROLE_USER')",
            uriTemplate: '/application_exchanges/{applicationId}',
            controller: PostApplicationExchangeByApplicationId::class,
            uriVariables: [],
            openapiContext: [
                'summary' => 'Create an exchange for an application',
                'parameters' => [
                    [
                        'name' => 'applicationId',
                        'in' => 'path',
                        'required' => true,
                        'schema' => [
                            'type' => 'string',
                            'format' => 'uuid',

                        ]
                    ]
                ],
                'requestBody' => [
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'message' => [
                                        'type' => 'string',
                                        'format' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ]
                ]
            ],
        ),
    ]
)]
#[ORM\Entity(repositoryClass: ApplicationExchangeRepository::class)]
class ApplicationExchange
{
    use Uuid;
    use CreatedDate;

    #[ORM\Column(type: 'text')]
    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        Application::OPERATION_NAME_GET_APPLICATIONEXCHANGES_BY_APPLICATION_ID,
        Application::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT
    ])]
    #[Assert\NotNull()]
    private $message;

    #[ORM\ManyToOne(targetEntity: Application::class, inversedBy: 'applicationExchanges')]
    #[ORM\JoinColumn(nullable: false)]
    private $application;

    #[ORM\Column(type: 'uuid')]
    #[Groups([Application::OPERATION_NAME_GET_APPLICATIONEXCHANGES_BY_APPLICATION_ID])]
    private UuidV6 $receiver;

    #[ORM\ManyToOne(targetEntity: UserPhysical::class)]
    #[Groups([Application::OPERATION_NAME_GET_APPLICATIONEXCHANGES_BY_APPLICATION_ID])]
    private $transmitter;

    #[ORM\Column]
    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        Application::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT,
        Application::OPERATION_NAME_GET_APPLICATIONEXCHANGES_BY_APPLICATION_ID
    ])]
    private ?bool $isRead = null;

    public function __construct()
    {
        $this->isRead = false;
        $this->createdDate = new \DateTime();
    }

    #[Groups([
        Applicant::OPERATION_NAME_GET_APPLICATIONS_BY_APPLICANT_ID,
        Application::OPERATION_NAME_GET_APPLICATIONS_BY_CURRENT_APPLICANT,
        Application::OPERATION_NAME_GET_APPLICATIONEXCHANGES_BY_APPLICATION_ID
    ])]
    public function getCreatedDate(): ?DateTime
    {
        return $this->createdDate;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }

    public function setApplication(?Application $application): self
    {
        $this->application = $application;

        return $this;
    }

    public function getReceiver(): ?UuidV6
    {
        return $this->receiver;
    }

    public function setReceiver(?UuidV6 $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getTransmitter(): ?UserPhysical
    {
        return $this->transmitter;
    }

    public function setTransmitter(?UserPhysical $transmitter): self
    {
        $this->transmitter = $transmitter;

        return $this;
    }

    public function isIsRead(): ?bool
    {
        return $this->isRead;
    }

    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;

        return $this;
    }
}
