<?php
namespace App\Entity\Company;

use App\Trait\UseCreatedDate;
use App\Trait\UseUuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company Subscription
 *
 * @ORM\Entity
 */
class CompanySubscription
{
    use UseUuid;
    use UseCreatedDate;

    const SUBSCRIPTION_SLUG_BEGINNER = 'beginner';
    const SUBSCRIPTION_SLUG_RECRUITER = 'recruiter';
    const SUBSCRIPTION_SLUG_EMPLOYER_BRAND = 'employer_brand';

    const SUBSCRIPTIONS_SLUGS = [
        self::SUBSCRIPTION_SLUG_BEGINNER,
        self::SUBSCRIPTION_SLUG_RECRUITER,
        self::SUBSCRIPTION_SLUG_EMPLOYER_BRAND
    ];

    const SUBSCRIPTION_SLUG_DEFAULT = self::SUBSCRIPTION_SLUG_BEGINNER;

    /**
     * CompanySubscription Group
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Company\CompanyGroup", inversedBy="subscription")
     */
    private CompanyGroup $companyGroup;

    /**
     * CompanySubscription Slug
     *
     * @ORM\Column(type="string")
     */
    private string $slug;

    /**
     * CompanySubscription constructor
     */
    public function __construct()
    {
        $this->createdDate = new \DateTime;
    }

    /**
     * Get the CompanyGroup attached to
     */
    public function getCompanyGroup(): CompanyGroup
    {
        return $this->companyGroup;
    }

    /**
     * Set the CompanyGroup attached to
     */
    public function setCompanyGroup(CompanyGroup $companyGroup): self
    {
        $this->company = $companyGroup;

        return $this;
    }

    /**
     * Check if has a valid CompanyGroup attached to
     */
    public function hasCompanyGroup()
    {
        return $this->companyGroup instanceof CompanyGroup;
    }

    /**
     * Get CompanySubscription Slug
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Set CompanySubscription Slug
     */
    public function setSlug(string $slug): self
    {
        if (self::isSlug($slug)) {
            $this->slug = $slug;
        }

        return $this;
    }

    /**
     * Check if the CompanySubscription has a valid Slug value
     */
    public function hasSlug(): bool
    {
        return self::isSlug($this->getSlug());
    }

    /**
     * Check if given Subscription Slug is valid
     */
    static public function isSlug(string $slug): bool
    {
        return is_string($slug) && array_key_exists($slug, self::SUBSCRIPTIONS_SLUGS);
    }
}
