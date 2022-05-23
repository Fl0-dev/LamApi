<?php

namespace App\Entity\Offer;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\Entity\CompanyEntity;
use App\Entity\Offer\OfferDetails;
use App\Entity\Offer\OfferContent;
use App\Repository\OfferRepository;
use App\Functional\EntityWorkflow;
use App\Transversal\TechnicalProperties;
use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Entity
 */
#[ApiResource]
class Offer extends OfferRepository
{
    use TechnicalProperties;

    use EntityWorkflow;
    use OfferDetails;
    use OfferContent;

    /**
     * ID for the CompanyEntity that owns the offer
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Company\Entity\CompanyEntity", inversedBy="offers")
     */
    private CompanyEntity $companyEntity;

    /**
     * Indicates if the Offer is provided or not
     *
     * @ORM\Column(type="boolean")
     */
    private bool $provided = false;

    /**
     * Offer title
     *
     * @ORM\Column(type="string")
     */
    private ?string $title = null;

    /**
     * Offer Contructor
     */
    public function __construct()
    {
    }

    /**
     * Get the Offer CompanyEntity
     */
    public function getCompanyEntity(): ?CompanyEntity
    {
        return $this->companyEntity;
    }

    /**
     * Set the Offer CompanyEntity
     */
    public function setCompanyEntity(?CompanyEntity $companyEntity): self
    {
        $this->company = $companyEntity;

        return $this;
    }

    /**
     * Check if Offer has a valid CompanyEntity
     */
    public function hasCompanyEntity(): bool
    {
        return $this->companyEntity instanceof CompanyEntity;
    }

    /**
     * Get value of Provided
     */
    public function isProvided(): bool
    {
        return $this->provided;
    }

    /**
     * Set value of Provided
     */
    public function setProvided(bool $provided): self
    {
        $this->provided = $provided;

        return $this;
    }

    /**
     * Get Offer Title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set Offer Title
     */
    public function setTitle($title): self
    {
        $title = trim($title);

        $hasFH = preg_match('/\s*-*\s*\(*[fh][\/-]+[fh]+\s*[\/-]*\)*\s*/i', $title);

        if (!$hasFH) {
            $title = "$title f/h";
        }

        $this->title = $title;

        return $this;
    }

    /**
     * Check if Offer has a valid Title
     */
    public function hasTitle(): bool
    {
        $title = $this->getTitle();

        return is_string($title) && strlen($title) > 0;
    }
}
