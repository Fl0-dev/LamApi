<?php

namespace App\Entity\Company\Group;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\Entity\CompanyEntity;
use App\Entity\Company\Group\CompanyGroupActivity;
use App\Entity\Company\Group\CompanyGroupCommunication;
use App\Entity\Company\Group\CompanyGroupIdentity;
use App\Functional\EntityWorkflow;
use App\Transversal\TechnicalProperties;
use App\Utils\Constants;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Company Group
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
#[ApiResource(routePrefix: '/company')]
class CompanyGroup
{
    use TechnicalProperties;

    use EntityWorkflow;
    use CompanyGroupIdentity;
    use CompanyGroupActivity;
    use CompanyGroupCommunication;

    /**
     * CompanyGroup Subscription
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Company\Group\CompanyGroupSubscription", mappedBy="companyGroup")
     */
    private CompanyGroupSubscription $subscription;

    /**
     * CompanyGroup Primary Color (hexadecimal)
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $color = null;

    /**
     * Referral Code
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $referralCode = null;

    /**
     * True if has a Career Website view on our platform
     *
     * @ORM\Column(type="boolean")
     */
    private bool $careerWebsite = false;

    /**
     * True if Open to Recruitment
     *
     * @ORM\Column(type="boolean")
     */
    private bool $openToRecruitment = false;

    /**
     * CompanyGroup Entities
     *
     * @var ArrayCollection<CompanyEntity>
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Company\Entity\CompanyEntity", mappedBy="companyGroup", cascade={"persist"})
     */
    private iterable $entities;

    /**
     * CompanyGroup Constructor
     */
    public function __construct()
    {
        $this->jobTypes = new ArrayCollection();
        $this->badges = new ArrayCollection();
        $this->tools = new ArrayCollection();
        $this->createdDate = new \DateTime;
    }

    /**
     * Get all Illustrations in the CompanyEntity page
     */
    public function getIllustrations(): ArrayCollection
    {
        $illustrations = new ArrayCollection();

        if ($this->hasMainMedia() && $this->getMainMedia()->isImage()) {
            $illustrations->add($this->getMainMedia());
        }

        foreach ($this->getEntities()->toArray() as $entity) {
            if ($entity->hasOfficesMedias()) {
                $officesMedias = $entity->getOfficesMedias()->toArray();
                shuffle($officesMedias);

                foreach ($officesMedias as $officeMedia) {
                    $illustrations->add($officeMedia->media);
                }
            }
        }

        return $illustrations;
    }

    /**
     * Get CompanyGroup Subscription
     */
    public function getSubscription(): CompanyGroupSubscription
    {
        return $this->subscription;
    }

    /**
     * Set CompanyGroup Subscription
     */
    public function setSubscription(CompanyGroupSubscription $subscription): self
    {
        if (self::isSubscription($subscription)) {
            $this->subscription = $subscription;
        }

        return $this;
    }

    /**
     * Check if CompaGroup has a valid Subscription
     */
    public function hasSubscription(): bool
    {
        return self::isSubscription($this->getSubscription());
    }

    /**
     * Check if given Subscription is a valid Subscription
     */
    static public function isSubscription($subscription): bool
    {
        return $subscription instanceof CompanyGroupSubscription && $subscription->hasSubscription();
    }

    /**
     * Get CompanyGroup Anniversary Date
     */
    public function getAnniversaryDate(): ?\DateTime
    {
        return $this->lastSubscriptionDate;
    }

    /**
     * Set CompanyGroup Anniversary Date
     */
    public function setAnniversaryDate(\DateTime|string|null $lastSubscriptionDate): self
    {
        if (is_string($lastSubscriptionDate)) {
            $lastSubscriptionDate = Utils::createDateTimeFromString($lastSubscriptionDate);
        }

        $this->lastSubscriptionDate = $lastSubscriptionDate;

        return $this;
    }

    /**
     * Check if CompanyGroup has a valid Anniversary Date
     */
    public function hasAnniversaryDate(): bool
    {
        return $this->getAnniversaryDate() instanceof \DateTime;
    }

    /**
     * Get Color value
     */
    public function getColor(): ?string
    {
        if (!Utils::isHexColor($this->color)) {
            return Constants::LAMACOMPTA_PRIMARY_COLOR;
        }

        return $this->color;
    }

    /**
     * Set true if Color, false else
     */
    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Check if a correct value (hexadecimal) is in $color property
     */
    public function hasColor(): bool
    {
        return Utils::isHexColor($this->getColor());
    }

        /**
     * Get Company Code Parrain
     */
    public function getCodeParrain(): ?string
    {
        return $this->codeParrain;
    }

    /**
     * Set Company Code Parrain
     */
    public function setCodeParrain(?string $codeParrain): self
    {
        $this->codeParrain = $codeParrain;

        return $this;
    }

    /**
     * Check if has a valid Code Parrain
     */
    public function hasCodeParrain(): bool
    {
        $codeParrain = $this->getCodeParrain();

        return is_string($codeParrain) && strlen($codeParrain) > 0;
    }

    /**
     * Get true if siteCarriere, false else
     */
    public function isSiteCarriere(): bool
    {
        return $this->siteCarriere;
    }

    /**
     * Set true if SiteCarriere, false else
     */
    public function setSiteCarriere(bool $siteCarriere): self
    {
        $this->siteCarriere = (bool) $siteCarriere;

        return $this;
    }

    /**
     * Get true if openToRecruitment, false else
     */
    public function isOpenToRecruitment(): bool
    {
        return $this->openToRecruitment;
    }

    /**
     * Set true if openToRecruitment, false else
     */
    public function setOpenToRecruitment(bool $openToRecruitment): self
    {
        $this->openToRecruitment = (bool) $openToRecruitment;

        return $this;
    }

    /**
     * Check if a correct value (bool) is in $openToRecruitment property
     */
    public function hasOpenToRecruitment(): bool
    {
        return is_bool($this->isOpenToRecruitment());
    }

    /**
     * Get CompanyEntities of CompanyGroup
     */
    public function getEntities(): ArrayCollection
    {
        return $this->entities;
    }

    /**
     * Set CompanyEntities of CompanyGroup
     */
    public function setEntities(ArrayCollection|array|null $entities): self
    {
        $entities = Utils::createArrayCollection($entities);

        $this->entities = $entities;

        return $this;
    }

    /**
     * Add a CompanyEntity to the CompanyGroup
     */
    public function addEntity(CompanyEntity $entity): self
    {
        $this->entities->add($entity);

        return $this;
    }

    /**
     * Remove a CompanyEntity to the CompanyGroup
     */
    public function removeEntity(CompanyEntity $entity): self
    {
        $this->entities->remove($entity);

        return $this;
    }

    /**
     * Check if CompanyGroup has CompanyEntities
     */
    public function hasEntities(): bool
    {
        $entities = $this->getEntities();

        return $entities instanceof ArrayCollection && !$entities->isEmpty();
    }
}
