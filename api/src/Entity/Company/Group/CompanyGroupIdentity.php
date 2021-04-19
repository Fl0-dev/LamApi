<?php

namespace App\Entity\Company\Group;

use App\Entity\Media\Media;
use App\Entity\Media\MediaImage;
use App\Entity\Media\MediaVideo;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyGroup Identity
 */
trait CompanyGroupIdentity
{
    /**
     * CompanyGroup Name
     *
     * @ORM\Column(type="string", length=100)
     */
    private ?string $name = null;

    /**
     * CompanyGroup Logo
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Media\MediaImage")
     */
    private ?MediaImage $logo = null;

    /**
     * Year of the CompanyGroup creation
     *
     * @ORM\Column(type="integer")
     */
    private ?int $creationYear = null;

    /**
     * Global HR Mail Address
     *
     * @ORM\Column(type="string", length=255)
     */
    private ?string $globalHrMailAddress = null;

    /**
     * CompanyGroup Turnover
     *
     * @ORM\Column(type="integer")
     */
    private ?int $turnover = null;

    /**
     * Media (image or video) of the header page CompanyGroup
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Media\Media")
     */
    private MediaImage|MediaVideo|null $headerMedia = null;

    /**
     * Main CompanyGroup media (image or video)
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Media\Media")
     */
    private MediaImage|MediaVideo|null $mainMedia = null;

    /**
     * List of other medias
     *
     * @var ArrayCollection<Media>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Media\Media")
     * @ORM\JoinTable(name="company_group_medias",
     *      joinColumns={@ORM\JoinColumn(name="company_group_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id")}
     * )
     */
    private iterable $medias;

    /**
     * "Who are we" CompanyGroup
     *
     * @ORM\Column(type="string", length=5000)
     */
    private ?string $usText = null;

    /**
     * CompanyGroup values
     *
     * @ORM\Column(type="string", length=5000)
     */
    private ?string $values = null;

    /**
     * Get CompanyGroup Name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set CompanyGroup Name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Check if CompanyGroup has a valid Name
     */
    public function hasName(): bool
    {
        $name = $this->getName();

        return is_string($name) && strlen($name) > 0;
    }

    /**
     * Get CompanyGroup Logo
     */
    public function getLogo(): ?MediaImage
    {
        return $this->logo;
    }

    /**
     * Set CompanyGroup Logo
     */
    public function setLogo(?MediaImage $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Check if CompanyGroup has a valid Logo
     */
    public function hasLogo()
    {
        $logo = $this->getLogo();

        return $logo instanceof MediaImage && $logo->hasSrc();
    }

    /**
     * Get the CompanyGroup Creation Year
     */
    public function getCreationYear(): ?int
    {
        return $this->creationYear;
    }

    /**
     * Set the CompanyGroup Creation Year
     */
    public function setCreationYear(?int $creationYear): self
    {
        if (!self::isCreationYear($creationYear)) {
            $creationYear = null;
        }

        $this->creationYear = $creationYear;

        return $this;
    }

    /**
     * Check if the CompanyGroup has a valid Creation Year
     */
    public function hasCreationYear(): bool
    {
        return self::isCreationYear($this->getCreationYear());
    }

    /**
     * Check if given year is a valid Creation Year
     */
    static public function isCreationYear(mixed $creationYear): bool
    {
        $creationYear = (int) $creationYear;

        return is_int($creationYear) && $creationYear > 1800 && $creationYear <= date('Y');
    }

    /**
     * Get CompanyGroup Global HR Mail Address
     */
    public function getGlobalHrMailAddress(): ?string
    {
        return $this->globalHrMailAddress;
    }

    /**
     * Set CompanyGroup Global HR Mail Address
     */
    public function setGlobalHrMailAddress(?string $globalHrMailAddress): self
    {
        if (filter_var($globalHrMailAddress, FILTER_VALIDATE_EMAIL) || is_null($globalHrMailAddress)) {
            $this->globalHrMailAddress = $globalHrMailAddress;
        }

        return $this;
    }

    /**
     * Check if the CompanyGroup has a valid Global HR Mail Address
     */
    public function hasGlobalHrMailAddress(): bool
    {
        $globalHrMailAddress = $this->getGlobalHrMailAddress();

        return is_string($globalHrMailAddress)
            && strlen($globalHrMailAddress) > 0
            && filter_var($globalHrMailAddress, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Get CompanyGroup Turnover
     */
    public function getTurnover(): ?int
    {
        return $this->turnover;
    }

    /**
     * Set CompanyGroup Turnover
     */
    public function setTurnover(?int $turnover): self
    {
        if (!self::isTurnover($turnover)) {
            $turnover = null;
        }

        $this->turnover = $turnover;

        return $this;
    }

    /**
     * Check if has a correct Turnover
     */
    public function hasTurnover(): bool
    {
        return self::isTurnover($this->getTurnover());
    }

    /**
     * Check if given Turnover is a valid Turnover value
     */
    static public function isTurnover(mixed $turnover): bool
    {
        $turnover = (int) $turnover;

        return is_int($turnover) && $turnover > 1;
    }

    /**
     * Get Media (image or video) of the CompanyGroup Page Header
     */
    public function getHeaderMedia(): MediaImage|MediaVideo|null
    {
        return $this->headerMedia;
    }

    /**
     * Set Media (image or video) of the CompanyGroup Page Header
     */
    public function setHeaderMedia(MediaImage|MediaVideo|null $headerMedia): self
    {
        $this->headerMedia = $headerMedia;

        return $this;
    }

    /**
     * Check if the CompanyGroup has a valid Header Media
     */
    public function hasHeaderMedia()
    {
        $headerMedia = $this->getHeaderMedia();

        return ($headerMedia instanceof Media && $headerMedia->hasSrc());
    }

    /**
     * Get CompanyGroup Main Media (image or video)
     */
    public function getMainMedia(): MediaImage|MediaVideo|null
    {
        return $this->mainMedia;
    }

    /**
     * Set CompanyGroup Main Media (image or video)
     */
    public function setMainMedia(MediaImage|MediaVideo|null $mainMedia): self
    {
        $this->mainMedia = $mainMedia;

        return $this;
    }

    /**
     * Check if the CompanyGroup has a valid Main Media
     */
    public function hasMainMedia(): bool
    {
        $mainMedia = $this->getMainMedia();

        return $mainMedia instanceof Media && $mainMedia->hasSrc();
    }

    /**
     * Get list of other medias
     */
    public function getMedias(): ArrayCollection
    {
        return $this->medias;
    }

    /**
     * Set list of other medias
     */
    public function setMedias(ArrayCollection|array|null $medias): self
    {
        $medias = Utils::createArrayCollection($medias);

        $this->medias = $medias;

        return $this;
    }

    /**
     * Check if Other Medias
     */
    public function hasMedias(): bool
    {
        $medias = $this->getMedias();

        return $medias instanceof ArrayCollection
            && !$medias->isEmpty()
            && Utils::checkArrayValuesObject($medias, Media::class);
    }

    /**
     * Get CompanyGroup "Who are we"
     */
    public function getUsText(): ?string
    {
        return $this->usText;
    }

    /**
     * Set CompanyGroup "Who are we"
     */
    public function setUsText(?string $usText): self
    {
        $this->usText = $usText;

        return $this;
    }

    /**
     * Check if CompanyGroup has a valid "Who are we" value
     */
    public function hasUsText(): bool
    {
        $usText = trim($this->getUsText());

        return is_string($usText) && strlen($usText) > 0;
    }

    /**
     * Get CompanyGroup Values
     */
    public function getValues(): ?string
    {
        return $this->values;
    }

    /**
     * Set CompanyGroup Values
     */
    public function setValues(?string $values): self
    {
        $this->values = $values;

        return $this;
    }

    /**
     * Check if CompanyGroup has valid Values
     */
    public function hasValues(): bool
    {
        $values = trim($this->getValues());

        return is_string($values) && strlen($values) > 0;
    }
}
