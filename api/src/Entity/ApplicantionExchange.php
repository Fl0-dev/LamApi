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

    #[ORM\ManyToOne(targetEntity: UserPhysical::class)]
    private $receiver;

    #[ORM\ManyToOne(targetEntity: UserPhysical::class)]
    private $transmitter;

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

    public function getReceiver(): ?UserPhysical
    {
        return $this->receiver;
    }

    public function setReceiver(?UserPhysical $receiver): self
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
}
