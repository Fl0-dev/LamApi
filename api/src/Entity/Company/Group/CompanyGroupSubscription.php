<?php
namespace App\Entity\Company\Group;

use App\Entity\Subscription;
use App\Transversal\CreatedDate;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company Subscription
 *
 */
#[ORM\Entity]
class CompanyGroupSubscription
{
    use Uuid;
    use CreatedDate;

    /**
     * CompanyGroup
     *
     */
    #[ORM\OneToOne(targetEntity: CompanyGroup::class, inversedBy: "subscription")]
    private ?CompanyGroup $companyGroup = null;

    /**
     * Subscription
     *
     */
    #[ORM\OneToOne(targetEntity: Subscription::class)]
    private ?Subscription $subscription = null;

    /**
     * CompanySubscription constructor
     */
    public function __construct(?CompanyGroup $companyGroup = null)
    {
        $this->companyGroup = $companyGroup;
        $this->createdDate = new \DateTime;
    }

    /**
     * Get the CompanyGroup attached to
     */
    public function getCompanyGroup(): ?CompanyGroup
    {
        return $this->companyGroup;
    }

    /**
     * Set the CompanyGroup attached to
     */
    public function setCompanyGroup(?CompanyGroup $companyGroup): self
    {
        $this->companyGroup = $companyGroup;

        return $this;
    }

    /**
     * Check if has a valid CompanyGroup attached to
     */
    public function hasCompanyGroup(): bool
    {
        return $this->companyGroup instanceof CompanyGroup;
    }

    /**
     * Get the Subscription
     */
    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

    /**
     * Set the Subscription
     */
    public function setSubscription(?Subscription $subscription): self
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * Check if has a valid Subscription
     */
    public function hasSubscription(): bool
    {
        $subscription = $this->getSubscription();

        return $subscription instanceof Subscription && $subscription->hasSlug();
    }
}
