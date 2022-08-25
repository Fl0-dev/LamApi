<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompanyEntityRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompanyEntityRepository::class)]
#[ApiResource()]
class CompanyEntity
{
    use Uuid;
    use Slug;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read:getOfferDetails', 'read:getCompanyGroupOffices'])]
    private $hrMail;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $officeNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["read:getAllTeaserCompanyGroups", "read:getCompanyGroupDetails", 'read:getCompanyGroupOffices'])]
    private $name;

    #[ORM\ManyToOne(targetEntity: CompanyGroup::class, inversedBy: 'companyEntities')]
    private $companyGroup;

    #[ORM\ManyToMany(targetEntity: Employer::class)]
    private $admins;

    #[ORM\OneToMany(mappedBy: 'companyEntity', targetEntity: Application::class)]
    #[Groups(['read:getCompanyGroupApplications'])]
    private $applications;

    #[ORM\OneToMany(mappedBy: 'companyEntity', targetEntity: Offer::class)]
    #[Groups(["read:getCompanyGroupDetails", 'read:getCompanyGroupDetails', 'read:getCompanyGroupOffers'])]
    private $offers;

    #[ORM\OneToMany(mappedBy: 'companyEntity', targetEntity: CompanyEntityOffice::class, cascade: ['persist', 'remove'])]
    private Collection $companyEntityOffices;

    #[ORM\ManyToMany(targetEntity: Tool::class)]
    private Collection $tools;

    #[ORM\OneToMany(mappedBy: 'companyEntity', targetEntity: Media::class)]
    private Collection $medias;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Profil $profil = null;

    public function __construct()
    {
        $this->admins = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->offers = new ArrayCollection();
        $this->companyEntityOffices = new ArrayCollection();
        $this->tools = new ArrayCollection();
        $this->medias = new ArrayCollection();
    }

    public function getHrMail(): ?string
    {
        return $this->hrMail;
    }

    public function setHrMail(?string $hrMail): self
    {
        $this->hrMail = $hrMail;

        return $this;
    }

    public function getOfficeNumber(): ?int
    {
        return $this->officeNumber;
    }

    public function setOfficeNumber(?int $officeNumber): self
    {
        $this->officeNumber = $officeNumber;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCompanyGroup(): ?CompanyGroup
    {
        return $this->companyGroup;
    }

    public function setCompanyGroup(?CompanyGroup $companyGroup): self
    {
        $this->companyGroup = $companyGroup;

        return $this;
    }

    /**
     * @return Collection<int, Employer>
     */
    public function getAdmins(): Collection
    {
        return $this->admins;
    }

    public function addAdmin(Employer $admin): self
    {
        if (!$this->admins->contains($admin)) {
            $this->admins[] = $admin;
        }

        return $this;
    }

    public function removeAdmin(Employer $admin): self
    {
        $this->admins->removeElement($admin);

        return $this;
    }

    /**
     * @return Collection<int, Application>
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setCompanyEntity($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getCompanyEntity() === $this) {
                $application->setCompanyEntity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Offer>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers[] = $offer;
            $offer->setCompanyEntity($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getCompanyEntity() === $this) {
                $offer->setCompanyEntity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CompanyEntityOffice>
     */
    public function getCompanyEntityOffices(): Collection
    {
        return $this->companyEntityOffices;
    }

    public function addCompanyEntityOffice(CompanyEntityOffice $companyEntityOffice): self
    {
        if (!$this->companyEntityOffices->contains($companyEntityOffice)) {
            $this->companyEntityOffices->add($companyEntityOffice);
            $companyEntityOffice->setCompanyEntity($this);
        }

        return $this;
    }

    public function removeCompanyEntityOffice(CompanyEntityOffice $companyEntityOffice): self
    {
        if ($this->companyEntityOffices->removeElement($companyEntityOffice)) {
            // set the owning side to null (unless already changed)
            if ($companyEntityOffice->getCompanyEntity() === $this) {
                $companyEntityOffice->setCompanyEntity(null);
            }
        }

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
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->medias->add($media);
            $media->setCompanyEntity($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getCompanyEntity() === $this) {
                $media->setCompanyEntity(null);
            }
        }

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }
}
