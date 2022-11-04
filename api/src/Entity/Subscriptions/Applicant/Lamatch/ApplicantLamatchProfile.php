<?php

namespace App\Entity\Subscriptions\Applicant\Lamatch;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Applicant\Applicant;
use App\Entity\Badge;
use App\Entity\ExpertiseField;
use App\Entity\JobTitle;
use App\Entity\Media\MediaImage;
use App\Entity\Subscriptions\DISC\DISCQuality;
use App\Entity\Tool;
use App\Repository\SubscriptionRepositories\Applicant\ApplicantLamatchProfileRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicantLamatchProfileRepository::class)]
#[ApiResource]
class ApplicantLamatchProfile
{
    use Uuid;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $introduction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $experience = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $levelOfStudy = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?MediaImage $photo = null;

    #[ORM\ManyToOne]
    private ?JobTitle $jobTitle = null;

    #[ORM\ManyToMany(targetEntity: Tool::class)]
    private Collection $tools;

    #[ORM\ManyToMany(targetEntity: Badge::class)]
    private Collection $desiredBadges;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Applicant $applicant = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?DesiredLocation $desiredLocation = null;

    #[ORM\ManyToMany(targetEntity: DISCQuality::class)]
    private Collection $qualities;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $desiredWorkforce = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $desiredCompanyAge = null;

    #[ORM\ManyToMany(targetEntity: ExpertiseField::class)]
    private Collection $desiredExpertiseFields;

    public function __construct()
    {
        $this->tools = new ArrayCollection();
        $this->desiredBadges = new ArrayCollection();
        $this->qualities = new ArrayCollection();
        $this->desiredExpertiseFields = new ArrayCollection();
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(?string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getLevelOfStudy(): ?string
    {
        return $this->levelOfStudy;
    }

    public function setLevelOfStudy(?string $levelOfStudy): self
    {
        $this->levelOfStudy = $levelOfStudy;

        return $this;
    }

    public function getPhoto(): ?MediaImage
    {
        return $this->photo;
    }

    public function setPhoto(?MediaImage $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getJobTitle(): ?JobTitle
    {
        return $this->jobTitle;
    }

    public function setJobTitle(?JobTitle $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * @return Collection<int, Tool>
     */
    public function getTools(): Collection
    {
        return $this->tools;
    }

    public function addTool(Tool $tool): self
    {
        if (!$this->tools->contains($tool)) {
            $this->tools->add($tool);
        }

        return $this;
    }

    public function removeTool(Tool $tool): self
    {
        $this->tools->removeElement($tool);

        return $this;
    }

    /**
     * @return Collection<int, Badge>
     */
    public function getDesiredBadges(): Collection
    {
        return $this->desiredBadges;
    }

    public function addDesiredBadge(Badge $desiredBadge): self
    {
        if (!$this->desiredBadges->contains($desiredBadge)) {
            $this->desiredBadges->add($desiredBadge);
        }

        return $this;
    }

    public function removeDesiredBadge(Badge $desiredBadge): self
    {
        $this->desiredBadges->removeElement($desiredBadge);

        return $this;
    }

    public function getApplicant(): ?Applicant
    {
        return $this->applicant;
    }

    public function setApplicant(Applicant $applicant): self
    {
        $this->applicant = $applicant;

        return $this;
    }

    public function getDesiredLocation(): ?DesiredLocation
    {
        return $this->desiredLocation;
    }

    public function setDesiredLocation(?DesiredLocation $desiredLocation): self
    {
        $this->desiredLocation = $desiredLocation;

        return $this;
    }

    /**
     * @return Collection<int, DISCQuality>
     */
    public function getQualities(): Collection
    {
        return $this->qualities;
    }

    public function addQuality(DISCQuality $quality): self
    {
        if (!$this->qualities->contains($quality)) {
            $this->qualities->add($quality);
        }

        return $this;
    }

    public function removeQuality(DISCQuality $quality): self
    {
        $this->qualities->removeElement($quality);

        return $this;
    }

    public function getDesiredWorkforce(): ?string
    {
        return $this->desiredWorkforce;
    }

    public function setDesiredWorkforce(?string $desiredWorkforce): self
    {
        $this->desiredWorkforce = $desiredWorkforce;

        return $this;
    }

    public function getDesiredCompanyAge(): ?string
    {
        return $this->desiredCompanyAge;
    }

    public function setDesiredCompanyAge(?string $desiredCompanyAge): self
    {
        $this->desiredCompanyAge = $desiredCompanyAge;

        return $this;
    }

    /**
     * @return Collection<int, ExpertiseField>
     */
    public function getDesiredExpertiseFields(): Collection
    {
        return $this->desiredExpertiseFields;
    }

    public function addDesiredExpertiseField(ExpertiseField $desiredExpertiseField): self
    {
        if (!$this->desiredExpertiseFields->contains($desiredExpertiseField)) {
            $this->desiredExpertiseFields->add($desiredExpertiseField);
        }

        return $this;
    }

    public function removeDesiredExpertiseField(ExpertiseField $desiredExpertiseField): self
    {
        $this->desiredExpertiseFields->removeElement($desiredExpertiseField);

        return $this;
    }
}
