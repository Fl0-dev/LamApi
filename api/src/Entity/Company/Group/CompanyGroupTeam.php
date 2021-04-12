<?php

namespace App\Entity\Company\Group;

use App\Trait\UseUuid;
use App\Utils\Utils;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CompanyGroup Team
 *
 * @ORM\Entity
 */
class CompanyGroupTeam
{
    use UseUuid;

    /**
     * CompanyGroup
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Company\Group\CompanyGroup", inversedBy="teams")
     */
    private CompanyGroup $companyGroup;

    /**
     * Name
     *
     * @ORM\Column(type="string", length="50")
     */
    private ?string $name = null;

    /**
     * Medias
     *
     * @var ArrayCollection<CompanyGroupTeamMedia>
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Company\Group\CompanyGroupTeamMedia")
     * @ORM\JoinTable(name="company_group_team_medias",
     *      joinColumns={@JoinColumn(name="company_group_team_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="media_id", referencedColumnName="id")}
     * )
     */
    private iterable $medias;

    /**
     * Contructor
     */
    public function __construct(CompanyGroup $companyGroup)
    {
        $this->companyGroup = $companyGroup;
    }

    /**
     * Get the CompanyGroup
     */
    public function getCompanyGroup(): CompanyGroup
    {
        return $this->companyGroup;
    }

    /**
     * Set the CompanyGroup
     */
    public function setCompanyGroup(CompanyGroup $companyGroup): self
    {
        $this->companyGroup = $companyGroup;

        return $this;
    }

    /**
     * Get Medias
     */
    public function getMedias(): ArrayCollection
    {
        return $this->medias;
    }

    /**
     * Set Medias
     */
    public function setMedias(ArrayCollection|array|null $medias): self
    {
        $medias = Utils::createArrayCollection($medias);

        $this->medias = $medias;

        return $this;
    }

    /**
     * Add a Media
     */
    public function addMedia(CompanyGroupTeamMedia $media): self
    {
        $this->medias->add($media);

        return $this;
    }

    /**
     * Remove a Media
     */
    public function removeMedia(CompanyGroupTeamMedia $media): self
    {
        $this->medias->remove($media);

        return $this;
    }

    /**
     * Check if has valid CompanyGroupTeamMedias
     */
    public function hasMedias()
    {
        $medias = $this->getMedias();

        return $medias instanceof ArrayCollection
            && !$medias->isEmpty()
            && Utils::checkArrayValuesObject($medias, CompanyGroupTeamMedia::class);
    }
}
