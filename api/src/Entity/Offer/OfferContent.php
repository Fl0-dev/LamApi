<?php

namespace App\Entity\Offer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer Content
 */
trait OfferContent
{
    /**
     * Missions
     *
     */
    #[ORM\Column(type: "text")]
    private ?string $missions = null;

    /**
     * Offer Needs
     *
     */
    #[ORM\Column(type: "text")]
    private ?string $needs = null;

    /**
     * The reasons to work with the Offer's Company
     *
     */
    #[ORM\Column(type: "text")]
    private ?string $workWithUs = null;

    /**
     * Prospects with the Offer's Company
     *
     */
    #[ORM\Column(type: "text")]
    private ?string $prospectWithUs = null;

    /**
     * Recruitment Process
     *
     */
    #[ORM\Column(type: "text")]
    private ?string $recruitmentProcess = null;


    /**
     * Get Missions
     */
    public function getMissions()
    {
        return $this->missions;
    }

    /**
     * Set Missions
     */
    public function setMissions(?string $missions): self
    {
        $this->missions = trim($missions);

        return $this;
    }

    /**
     * Check if has valid Missions
     */
    public function hasMissions()
    {
        $missions = $this->getMissions();

        return is_string($missions)
            && strlen($missions) > 0;
    }

    /**
     * Get Needs
     */
    public function getNeeds(): ?string
    {
        return $this->needs;
    }

    /**
     * Set Needs
     */
    public function setNeeds(?string $needs): self
    {
        $this->needs = $needs;

        return $this;
    }

    /**
     * Check if has valid Needs
     */
    public function hasNeeds(): bool
    {
        $needs = $this->getNeeds();

        return is_string($needs) && strlen($needs) > 0;
    }

    /**
     * Get Works With Us
     */
    public function getWorkWithUs(): ?string
    {
        return $this->workWithUs;
    }

    /**
     * Set Works With Us
     */
    public function setWorkWithUs(?string $workWithUs): self
    {
        $this->workWithUs = trim($workWithUs);

        return $this;
    }

    /**
     * Check if has valid Works With Us
     */
    public function hasWorkWithUs(): bool
    {
        $workWithUs = $this->getWorkWithUs();

        return is_string($workWithUs) && strlen($workWithUs) > 0;
    }

    /**
     * Get Prospects With Us
     */
    public function getProspectWithUs(): ?string
    {
        return $this->prospectWithUs;
    }

    /**
     * Set Prospects With Us
     */
    public function setProspectWithUs(?string $prospectWithUs): self
    {
        $this->prospectWithUs = trim($prospectWithUs);

        return $this;
    }

    /**
     * Check if has valid Prospects With Us
     */
    public function hasProspectWithUs(): bool
    {
        $prospectWithUs = $this->getProspectWithUs();

        return is_string($prospectWithUs) && strlen($prospectWithUs) > 0;
    }

    /**
     * Get Recruitment Process
     */
    public function getRecruitmentProcess(): ?string
    {
        return $this->recruitmentProcess;
    }

    /**
     * Set Recruitment Process
     */
    public function setRecruitmentProcess(?string $recruitmentProcess): self
    {
        $this->recruitmentProcess = trim($recruitmentProcess);

        return $this;
    }

    /**
     * Check if has valid Recruitment Process
     */
    public function hasRecruitmentProcess()
    {
        $recruitmentProcess = $this->getRecruitmentProcess();

        return is_string($recruitmentProcess) && strlen($recruitmentProcess) > 0;
    }
}
