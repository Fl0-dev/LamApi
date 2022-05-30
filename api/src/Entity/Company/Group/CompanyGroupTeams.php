<?php

namespace App\Entity\Company\Group;

use App\Utils\Utils;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

const WORKFORCE_SUFFIX = 'salariés';

const WORKFORCES = [
    1 => '1 à 9 ' . WORKFORCE_SUFFIX,
    2 => '10 à 19 ' . WORKFORCE_SUFFIX,
    3 => '20 à 49 ' . WORKFORCE_SUFFIX,
    4 => '50 à 99 ' . WORKFORCE_SUFFIX,
    5 => '100 à 199 ' . WORKFORCE_SUFFIX,
    6 => '200 à 499 ' . WORKFORCE_SUFFIX,
    7 => '500 à 999 ' . WORKFORCE_SUFFIX,
    8 => '1 000 à 1 999 ' . WORKFORCE_SUFFIX,
    9 => '2 000 à 4 999 ' . WORKFORCE_SUFFIX,
    10 => '5 000 à 9 999 ' . WORKFORCE_SUFFIX,
    11 => '+ de 10 000 ' . WORKFORCE_SUFFIX
];

/**
 * CompanyGroup Team
 */
trait CompanyGroupTeams
{
    /**
     * CompanyGroup Workforce
     *
     */
    #[ORM\Column(type: "integer")]
    private ?int $workforce = null;

    /**
     * CompanyGroup Middle Age
     *
     */
    #[ORM\Column(type: "integer")]
    private ?int $middleAge = null;

    /**
     * CompanyGroup Teams
     *
     * @var ArrayCollection<CompanyGroupTeam>
     *
     */
    #[ORM\OneToMany(targetEntity: CompanyGroupTeam::class, mappedBy: "companyGroup", cascade: ["persist", "remove"])]
    private iterable $teams;

    /**
     * Get workforce range label for the given workforce id
     */
    public static function getWorkforceRange(int $workforce): ?string
    {
        return Utils::getArrayValue($workforce, WORKFORCES);
    }

    /**
     * Get workforce ID for the given workforce range
     */
    public static function getWorkforceIdFromRange(string $workforceRange): int
    {
        return array_search($workforceRange, WORKFORCES);
    }

    /**
     * Check if given workforce id is a valid workforce id
     */
    public static function isWorkforceRange(int $workforce): bool
    {
        return array_key_exists($workforce, WORKFORCES);
    }

    /**
     * Get CompanyGroupTeam workforce
     */
    public function getWorkforce(): ?int
    {
        return $this->workforce;
    }

    /**
     * Set CompanyGroupTeam workforce
     */
    public function setWorkforce(?int $workforce): self
    {
        if (self::isWorkforceRange($workforce) || is_null($workforce)) {
            $this->workforce = $workforce;
        }

        return $this;
    }

    /**
     * Check if the CompanyGroupTeam has a valid Workforce value
     */
    public function hasWorkforce(): bool
    {
        $workforce = $this->getWorkforce();

        return (is_int($workforce) && self::isWorkforceRange($workforce));
    }

    /**
     * Get CompanyGroupTeam Middle Age
     */
    public function getMiddleAge(): ?int
    {
        return $this->middleAge;
    }

    /**
     * Set CompanyGroupTeam Middle Age
     */
    public function setMiddleAge(?int $middleAge): self
    {
        $this->middleAge = $middleAge;

        return $this;
    }

    /**
     * Check if the CompanyGroupTeam has a valid Middle Age value
     */
    public function hasMiddleAge(): bool
    {
        $middleAge = $this->getMiddleAge();

        return (is_int($middleAge) && $middleAge > 18 && $middleAge <= 80);
    }

    /**
     * Get CompanyGroupTeam Teams
     */
    public function getTeams(): ArrayCollection
    {
        return $this->teams;
    }

    /**
     * Set CompanyGroupTeam Team Medias
     */
    public function setTeams(ArrayCollection|array|null $teams): self
    {
        $teams = Utils::createArrayCollection($teams);

        $this->teams = $teams;

        return $this;
    }

    /**
     * Check if CompanyGroupTeam has valid Team Medias
     */
    public function hasTeams()
    {
        $teams = $this->getTeams();

        return $teams instanceof ArrayCollection
            && !$teams->isEmpty()
            && Utils::checkArrayValuesObject($teams, CompanyGroupTeam::class);
    }
}
