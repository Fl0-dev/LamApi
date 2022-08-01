<?php

namespace App\Entity;

use App\Repository\ApplicantionExchangeRepository;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantionExchangeRepository::class)]
class ApplicantionExchange
{
    use Uuid;
    use CreatedDate;

    #[ORM\Column(type: 'text')]
    private $message;

    #[ORM\ManyToOne(targetEntity: Application::class, inversedBy: 'applicantionExchanges')]
    #[ORM\JoinColumn(nullable: false)]
    private $application;

    #[ORM\ManyToOne(targetEntity: UserConsumer::class)]
    private $receiver;

    #[ORM\ManyToOne(targetEntity: UserConsumer::class)]
    private $transmitter;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getReceiver(): ?UserConsumer
    {
        return $this->receiver;
    }

    public function setReceiver(?UserConsumer $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getTransmitter(): ?UserConsumer
    {
        return $this->transmitter;
    }

    public function setTransmitter(?UserConsumer $transmitter): self
    {
        $this->transmitter = $transmitter;

        return $this;
    }
}
