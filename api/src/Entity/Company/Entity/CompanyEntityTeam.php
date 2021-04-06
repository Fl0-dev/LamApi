<?php

namespace App\Entity\Company\CompanyEntity;

use App\Entity\Media;
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
 * CompanyEntity Team
 */
trait CompanyEntityTeam
{
    /**
     * CompanyEntityTeam Workforce
     *
     * @ORM\Column(type="integer")
     */
    private ?int $workforce = null;

    /**
     * CompanyEntityTeam Middle Age
     *
     * @ORM\Column(type="integer")
     */
    private ?int $middleAge = null;

    /**
     * Introduction text for the team
     *
     * @ORM\Column(type="string")
     */
    private ?string $teamIntro = null;

    /**
     * CompanyEntityTeam Medias
     *
     * @var ArrayCollection<Media>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Media")
     * @ORM\JoinTable(name="company_entity_team_medias",
     *      joinColumns={@JoinColumn(name="company_entity_team_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="media_id", referencedColumnName="id")}
     * )
     */
    private iterable $teamMedias;

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
     * Get CompanyEntityTeam workforce
     */
    public function getWorkforce(): ?int
    {
        return $this->workforce;
    }

    /**
     * Set CompanyEntityTeam workforce
     */
    public function setWorkforce(?int $workforce): self
    {
        if (self::isWorkforceRange($workforce) || is_null($workforce)) {
            $this->workforce = $workforce;
        }

        return $this;
    }

    /**
     * Check if the CompanyEntityTeam has a valid Workforce value
     */
    public function hasWorkforce(): bool
    {
        $workforce = $this->getWorkforce();

        return (is_int($workforce) && self::isWorkforceRange($workforce));
    }

    /**
     * Get CompanyEntityTeam Middle Age
     */
    public function getMiddleAge(): ?int
    {
        return $this->middleAge;
    }

    /**
     * Set CompanyEntityTeam Middle Age
     */
    public function setMiddleAge(?int $middleAge): self
    {
        $this->middleAge = $middleAge;

        return $this;
    }

    /**
     * Check if the CompanyEntityTeam has a valid Middle Age value
     */
    public function hasMiddleAge(): bool
    {
        $middleAge = $this->getMiddleAge();

        return (is_int($middleAge) && $middleAge > 18 && $middleAge <= 80);
    }

    /**
     * Get the Introduction text for the Team
     */
    public function getTeamIntro(): ?string
    {
        return $this->teamIntro;
    }

    /**
     * Set the Introduction text for the Team
     */
    public function setTeamIntro(?string $teamIntro): self
    {
        $this->teamIntro = $teamIntro;

        return $this;
    }

    /**
     * Check if Team has a valid Introduction text
     */
    public function hasTeamIntro(): bool
    {
        $teamIntro = $this->getTeamIntro();

        return (is_string($teamIntro) && strlen($teamIntro) > 0);
    }

    /**
     * Get CompanyEntityTeam Team Medias
     */
    public function getTeamMedias(): ArrayCollection
    {
        return $this->teamMedias;
    }

    /**
     * Set CompanyEntityTeam Team Medias
     */
    public function setTeamMedias(ArrayCollection|array|null $teamMedias): self
    {
        $teamMedias = Utils::createArrayCollection($teamMedias);

        $this->teamMedias = $teamMedias;

        return $this;
    }

    /**
     * Check if CompanyEntityTeam has valid Team Medias
     */
    public function hasTeamMedias()
    {
        $teamMedias = $this->getTeamMedias();

        return (
            $teamMedias instanceof ArrayCollection
            && $teamMedias->count() > 0
            && Utils::checkArrayValuesObject($teamMedias, Media::class)
        );
    }
}
