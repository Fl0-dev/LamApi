<?php

namespace App\Entity\Offer;

/**
 * Offer Content
 */
trait OfferContent
{
    /**
     * Missions
     *
     * @ORM\Column(type="string")
     */
    private ?string $missions = null;

    /**
     * Offer Needs
     *
     * @ORM\Column(type="string")
     */
    private ?string $needs = null;

    /**
     * The reasons to work with the Offer's Company
     *
     * @ORM\Column(type="string")
     */
    private ?string $worksWithUs = null;

    /**
     * Prospects with the Offer's Company
     *
     * @ORM\Column(type="string")
     */
    private ?string $prospectsWithUs = null;

    /**
     * Recruitment Process
     *
     * @ORM\Column(type="string")
     */
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
    public function getWorksWithUs(): ?string
    {
        return $this->worksWithUs;
    }

    /**
     * Set Works With Us
     */
    public function setWorksWithUs(?string $worksWithUs): self
    {
        $this->worksWithUs = trim($worksWithUs);

        return $this;
    }

    /**
     * Check if has valid Works With Us
     */
    public function hasWorksWithUs(): bool
    {
        $worksWithUs = $this->getWorksWithUs();

        return is_string($worksWithUs) && strlen($worksWithUs) > 0;
    }

    /**
     * Get Prospects With Us
     */
    public function getProspectsWithUs(): ?string
    {
        return $this->prospectsWithUs;
    }

    /**
     * Set Prospects With Us
     */
    public function setProspectsWithUs(?string $prospectsWithUs): self
    {
        $this->prospectsWithUs = trim($prospectsWithUs);

        return $this;
    }

    /**
     * Check if has valid Prospects With Us
     */
    public function hasProspectsWithUs(): bool
    {
        $prospectsWithUs = $this->getProspectsWithUs();

        return is_string($prospectsWithUs) && strlen($prospectsWithUs) > 0;
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
