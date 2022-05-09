<?php

namespace App\Entity\Company\Group;

use App\Entity\Media\Media;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyGroup Team Media
 *
 * @ORM\Entity
 */
class CompanyGroupTeamMedia
{
    use Uuid;

    /**
     * CompanyGroupTeam
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Company\Group\CompanyGroupTeam", inversedBy="medias")
     */
    private CompanyGroupTeam $companyGroupTeam;

    /**
     * Media
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Media\Media")
     */
    private ?Media $media = null;

    /**
     * Description
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description = null;

    /**
     * Media Destination (carousel, interviews...)
     *
     * @ORM\Column(type="string", length=50)
     */
    private ?string $destination = null;

    /**
     * CompanyGroupInterview Contructor
     */
    public function __construct(CompanyGroupTeam $companyGroupTeam)
    {
        $this->companyGroupTeam = $companyGroupTeam;
    }

    /**
     * Get the CompanyGroupTeam
     */
    public function getCompanyGroupTeam(): CompanyGroupTeam
    {
        return $this->companyGroupTeam;
    }

    /**
     * Set the CompanyGroupTeam
     */
    public function setCompanyGroupTeam(CompanyGroupTeam $companyGroupTeam): self
    {
        $this->companyGroupTeam = $companyGroupTeam;

        return $this;
    }

    /**
     * Get Media
     */
    public function getMedia(): ?Media
    {
        return $this->medias;
    }

    /**
     * Set Media
     */
    public function setMedia(?Media $media): self
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Check if has valid Media
     */
    public function hasMedia()
    {
        $media = $this->getMedia();

        return $media instanceof Media && $media->hasSrc();
    }

    /**
     * Get Description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set Description
     */
    public function setDescription(?string $description): self
    {
        $this->description = trim($description);

        return $this;
    }

    /**
     * Check if has valid Description
     */
    public function hasDescription()
    {
        $description = $this->getDescription();

        return is_string($description) && strlen($description) > 0;
    }

    /**
     * Get Destination
     */
    public function getDestination(): ?string
    {
        return $this->destination;
    }

    /**
     * Set Destination
     */
    public function setDestination(?string $destination): self
    {
        $this->destination = trim($destination);

        return $this;
    }

    /**
     * Check if has valid Destination
     */
    public function hasDestination()
    {
        $destination = $this->getDestination();

        return is_string($destination) && strlen($destination) > 0;
    }
}
