<?php

namespace App\Entity\Company;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Revision\CompanyEntityRevision;
use App\Entity\User\Employer;
use App\Entity\Media\Media;
use App\Entity\Company\CompanyProfile;
use App\Entity\Offer\Offer;
use App\Entity\Tool;
use App\Repository\CompanyRepositories\CompanyEntityRepository;
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
    #[Groups([
        Offer::OPERATION_NAME_GET_OFFER_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_OFFICES
    ])]
    private $hrMail;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $officeNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_OFFICES
    ])]
    private $name;

    #[ORM\ManyToOne(targetEntity: CompanyGroup::class, inversedBy: 'companyEntities', cascade: ['persist'])]
    private $companyGroup;

    #[ORM\ManyToMany(targetEntity: Employer::class)]
    private $admins;

    #[ORM\OneToMany(mappedBy: 'companyEntity', targetEntity: CompanyEntityOffice::class, cascade: ['persist', 'remove'])]
    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS, 
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS
    ])]
    private Collection $companyEntityOffices;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?CompanyProfile $profile = null;

    #[ORM\ManyToMany(targetEntity: Media::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinTable(name: "company_entity_has_media")]
    #[ORM\JoinColumn(name: "companyEntity_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "media_id", referencedColumnName: "id", unique: true)]
    private Collection $medias;

    #[ORM\OneToMany(mappedBy: 'companyEntity', targetEntity: CompanyEntityRevision::class, orphanRemoval: true)]
    private Collection $companyEntityRevisions;

    public function __construct()
    {
        $this->admins = new ArrayCollection();
        $this->companyEntityOffices = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->companyEntityRevisions = new ArrayCollection();
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

    public function getProfile(): ?CompanyProfile
    {
        return $this->profile;
    }

    public function setProfile(?CompanyProfile $profile): self
    {
        $this->profile = $profile;

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
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        $this->medias->removeElement($media);

        return $this;
    }

    /**
     * @return Collection<int, CompanyEntityRevision>
     */
    public function getCompanyEntityRevisions(): Collection
    {
        return $this->companyEntityRevisions;
    }

    public function addCompanyEntityRevision(CompanyEntityRevision $companyEntityRevision): self
    {
        if (!$this->companyEntityRevisions->contains($companyEntityRevision)) {
            $this->companyEntityRevisions->add($companyEntityRevision);
            $companyEntityRevision->setCompanyEntity($this);
        }

        return $this;
    }

    public function removeCompanyEntityRevision(CompanyEntityRevision $companyEntityRevision): self
    {
        $this->companyEntityRevisions->removeElement($companyEntityRevision);
            
        return $this;
    }
}
