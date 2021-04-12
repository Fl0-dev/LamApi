<?php

namespace App\Entity\Offer;

use App\Entity\Localisation\Address;
use App\Entity\Tool;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Offer Details
 */
trait OfferDetails
{
    use OfferDetailsExperience;

    /**
     * Offer Job Title ID
     *
     * @ORM\Column(type="integer")
     */
    private ?int $jobTitle = null;

    /**
     * Offer Contract type
     *
     * @ORM\Column(type="string")
     */
    private ?string $contractType = null;

    /**
     * Offer Fully Telework indicator
     *
     * @ORM\Column(type="boolean")
     */
    private bool $fullyTelework = false;

    /**
     * Weekly volume hours for this Offer
     *
     * @ORM\Column(type="float")
     */
    private ?float $weeklyHours = null;

    /**
     * Level of study required for this Offer
     *
     * @ORM\Column(type="integer")
     */
    private ?int $levelOfStudy = null;

    /**
     * Indicates if the job starts as soon as possible
     *
     * @ORM\Column(type="boolean")
     */
    private bool $startASAP = false;

    /**
     * Offer Start Date
     *
     * @ORM\Column(type="datetime")
     */
    private ?\DateTime $startDate = null;

    /**
     * Proposed Salary Min
     *
     * @ORM\Column(type="float")
     */
    private ?float $salaryMin = null;

    /**
     * Proposed Salary Max
     *
     * @ORM\Column(type="float")
     */
    private ?float $salaryMax = null;

    /**
     * Offer Localisation
     *
     * @OneToOne(targetEntity="App\Entity\Localisation\Address")
     */
    private ?Address $address = null;

    /**
     * Tools used in the Offer
     *
     * @var ArrayCollection<Tool>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Tool")
     * @ORM\JoinTable(name="offer_tools",
     *      joinColumns={@JoinColumn(name="offer_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="tool_id", referencedColumnName="id")}
     * )
     */
    private iterable $tools;


    /**
     * Get Offer Job Title
     */
    public function getJobTitle(): ?string
    {
        return Utils::getArrayValue($this->getJobTitleID(), self::getJobTitlesRef());
    }

    /**
     * Get Offer Job Title
     */
    public function getJobTitleID(): ?int
    {
        return $this->jobTitle;
    }

    /**
     * Set Offer Job Title
     */
    public function setJobTitle(?int $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Check if Offer has a valid Job Title value
     */
    public function hasJobTitle(): bool
    {
        return self::isJobTitle($this->getJobTitle());
    }

    /**
     * Check if given contract type id is a valid contract type id
     */
    public static function isJobTitle(mixed $jobTitle): bool
    {
        return is_int($jobTitle) && array_key_exists($jobTitle, self::getJobTitlesRef());
    }

    /**
     * Define and get references of Job Title
     */
    public static function getJobTitlesRef(): array
    {
        return [
            797 => "Assistant Comptable",
            956 => "Assistant Juridique - Droit des Sociétés",
            955 => "Assistant Juridique - Droit Social",
            945 => "Auditeur Assistant",
            958 => "Avocat - Droit des Sociétés",
            957 => "Avocat - Droit Social",
            946 => "Chef de Mission Audit",
            941 => "Chef de Mission Comptable",
            799 => "Collaborateur Comptable",
            950 => "Collaborateur Comptable et Audit",
            5149 => "Communication / Marketing",
            2580 => "Consultant Junior",
            2584 => "Consultant Manager",
            2582 => "Consultant Senior",
            951 => "Contrôleur de Gestion",
            949 => "Directeur Audit",
            944 => "Expert-Comptable",
            943 => "Expert-Comptable Stagiaire",
            19212 => "Fiscalité",
            19216 => "Gestion / Pilotage",
            19210 => "Gestion de patrimoine",
            952 => "Gestionnaire de Paie",
            16675 => "Informatique",
            1327 => "Juriste - Droit des sociétés",
            1329 => "Juriste - Droit social",
            947 => "Manager Audit",
            942 => "Manager Comptable",
            953 => "Responsable Paie",
            954 => "Secrétaire Juridique",
            948 => "Senior Manager Audit",
            19214 => "Transmission / Cession",
        ];
    }

    /**
     * Get Offer Contract Type Label
     */
    public function getContractType(): ?string
    {
        return Utils::getArrayValue($this->getContractTypeSlug(), self::getContractTypesRef());
    }

    /**
     * Get Offer Contract Type Slug
     */
    public function getContractTypeSlug(): ?string
    {
        return $this->contractType;
    }

    /**
     * Set Offer Contract Type
     */
    public function setContractType(?string $contractType): self
    {
        if (self::isContractType($contractType) || is_null($contractType)) {
            $this->contractType = $contractType;
        }

        return $this;
    }

    /**
     * Check if Offer has a valid Contract Type value
     */
    public function hasContractType(): bool
    {
        return $this->isContractType($this->getContractType());
    }

    /**
     * Check if given Contract Type is a valid Contract Type id
     */
    public static function isContractType(mixed $contractType): bool
    {
        return (!empty($contractType)
            && is_string($contractType)
            && array_key_exists($contractType, self::getContractTypesRef()));
    }

    /**
     * Define and get references of Contract Types
     */
    public static function getContractTypesRef(): array
    {
        return [
            'cdd' => 'CDD',
            'cdi' => 'CDI',
            'alternance' => 'Alternance',
            'internship'  => 'Stage',
            'freelance'  => 'Indépendant'
        ];
    }

    /**
     * Get Contract Type Slug from Contract Type Label
     */
    public static function getContractTypeSlugFromLabel(?string $label): string|false
    {
        return array_search($label, self::getContractTypesRef());
    }

    /**
     * Get Weekly Hours for this Offer
     */
    public function getWeeklyHours(): ?float
    {
        return $this->weeklyHours;
    }

    /**
     * Set Weekly Hours for this Offer
     */
    public function setWeeklyHours(?float $weeklyHours): self
    {
        $this->weeklyHours = $weeklyHours;

        return $this;
    }

    /**
     * Check if Offer has Weekly Hours value
     */
    public function hasWeeklyHours(): bool
    {
        return self::isWeeklyHours($this->getWeeklyHours());
    }

    /**
     * Check if given Weekly Hours is valid
     */
    public static function isWeeklyHours(mixed $weeklyHours): bool
    {
        return is_float($weeklyHours) && $weeklyHours > 0 && $weeklyHours < 80;
    }

    /**
     * Get render of Start Contract
     */
    public function getFormattingContractType(): ?string
    {
        return Utils::getArrayValue($this->getContractType(), $this->getContractTypesRef());
    }

    /**
     * Get indicates if the Job Starts as soon as possible
     */
    public function isStartASAP(): bool
    {
        return $this->startASAP;
    }

    /**
     * Set indicates if the Job Starts as soon as possible
     */
    public function setStartASAP(bool $startASAP): self
    {
        $this->startASAP = $startASAP;

        return $this;
    }

    /**
     * Check if Offer has a valid valud for provided property
     */
    public function hasStartASAP()
    {
        return is_bool($this->isStartASAP());
    }

    /**
     * Get Offer Start Date
     */
    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    /**
     * Set Offer Start Date
     */
    public function setStartDate(\DateTime|string|null $startDate): self
    {
        if (is_string($startDate)) {
            $startDate = Utils::createDateTimeFromString($startDate);
        }

        if ($startDate instanceof \DateTime || is_null($startDate)) {
            $this->startDate = $startDate;
        }

        return $this;
    }

    /**
     * Check if given Start Date is a valid Date
     */
    public static function isStartDate(mixed $startDate): bool
    {
        return $startDate instanceof \DateTime;
    }

    /**
     * Check if Offer has a valid Start Date
     */
    public function hasStartDate(): bool
    {
        return self::isStartDate($this->getStartDate());
    }

    /**
     * Get Proposed Salary Min
     */
    public function getSalaryMin(): ?float
    {
        return $this->salaryMin;
    }

    /**
     * Set Proposed Salary Min
     */
    public function setSalaryMin(?float $salaryMin): self
    {
        $this->salaryMin = $salaryMin;

        return $this;
    }

    /**
     * Check if Offer has a valid Min Salary
     */
    public function hasSalaryMin()
    {
        return self::isSalary($this->getSalaryMin());
    }

    /**
     * Get Proposed Salary Max
     */
    public function getSalaryMax(): ?float
    {
        return $this->salaryMax;
    }

    /**
     * Set Proposed Salary Max
     */
    public function setSalaryMax(?float $salaryMax): self
    {
        $this->salaryMax = $salaryMax;

        return $this;
    }

    /**
     * Check if Offer has a valid Max Salary
     */
    public function hasSalaryMax(): bool
    {
        return self::isSalary($this->getSalaryMax());
    }

    /**
     * Check if Offer has at least a Salary Min
     */
    public function hasSalary()
    {
        return $this->hasSalaryMin();
    }

    /**
     * Check if given salary is a valid salary
     */
    public static function isSalary(mixed $salary): bool
    {
        return is_float($salary) && $salary > 0;
    }

    /**
     * Get Level of Study required for this Offer
     */
    public function getLevelOfStudy(): ?int
    {
        return $this->levelOfStudy;
    }

    /**
     * Set Level of Study required for this Offer
     */
    public function setLevelOfStudy(?int $levelOfStudy): self
    {
        $this->levelOfStudy = $levelOfStudy;

        return $this;
    }

    /**
     * Check if Offer has a valid Level of Study value
     */
    public function hasLevelOfStudy(): bool
    {
        return $this->isLevelOfStudy($this->getLevelOfStudy());
    }

    /**
     * Check if given Level of Study ID is a valid Level of Study ID
     */
    public static function isLevelOfStudy(mixed $levelOfStudy): bool
    {
        return !empty($levelOfStudy)
            && is_int($levelOfStudy)
            && array_key_exists($levelOfStudy, self::getLevelsOfStudyRef());
    }

    /**
     * Get Short Label for the Level of Study for this Offer
     */
    public function getLevelOfStudyLabel(): ?string
    {
        return Utils::getArrayValue($this->getLevelOfStudy(), self::getLevelsOfStudyRef());
    }

    /**
     * Define and get Candidate Levels of study references
     */
    public static function getLevelsOfStudyRef(): array
    {
        return [
            0 => 'Non précisé',
            1 => 'Bac',
            2 => 'Bac + 1',
            3 => 'Bac + 2',
            4 => 'Bac + 3',
            5 => 'Bac + 4',
            6 => 'Bac + 5',
            7 => 'Bac + 6',
            8 => 'Bac + 7',
            9 => 'Bac + 8',
        ];
    }

    /**
     * Get Level of Study ID from Contract Type Label
     */
    public static function getLevelOfStudyIdFromLabel(?string $label): string|false
    {
        return array_search($label, self::getLevelsOfStudyRef());
    }

    /**
     * Check if Offer has at least one Key info
     */
    public function hasAtLeastOneKeyInfo()
    {
        return $this->hasExperience()
            || $this->hasContractType()
            || $this->hasLevelOfStudy()
            || $this->hasSalary();
    }

    /**
     * Get Offer Localisation Address
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * Set Offer Localisation Address
     */
    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Check if Offer has a valid Address Object
     */
    public function hasAddress(): bool
    {
        return $this->getAddress() instanceof Address;
    }

    /**
     * Get HR Mail Address Offer
     */
    public function getHrMailAddress(): ?string
    {
        if ($this->hasAddress()) {
            return $this->getAddress()->getHrMailAddress();
        }

        return null;
    }

    /**
     * Get list of Tools
     */
    public function getTools(): ArrayCollection
    {
        return $this->tools;
    }

    /**
     * Set list of Tools
     */
    public function setTools(ArrayCollection|array|null $tools): self
    {
        $tools = Utils::createArrayCollection($tools);

        $this->tools = $tools;

        return $this;
    }

    /**
     * Check if the CompanyGroup has Tools
     */
    public function hasTools(): bool
    {
        $tools = $this->getTools();

        return $tools instanceof ArrayCollection
            && !$tools->isEmpty()
            && Utils::checkArrayValuesObject($tools, Tool::class);
    }
}
