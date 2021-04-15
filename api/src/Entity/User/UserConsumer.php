<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;

class UserConsumer extends User
{
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * Indicates if the user wanted explicitly create its account (true)
     * or if it's Lamacompta without consentment (false)
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $optin;

    public function __construct()
    {

    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getOptin(): ?bool
    {
        return $this->optin;
    }

    public function setOptin(?bool $optin): self
    {
        $this->optin = $optin;

        return $this;
    }
}
