<?php

namespace App\Entity\Company;

use ApiPlatform\Core\Annotation\ApiResource;
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
    #[Groups([Offer::OPERATION_NAME_GET_OFFER_DETAILS, CompanyGroup::OPERATION_NAME_GET_COMPANY_OFFICES])]
    private $hrMail;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $officeNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS, CompanyGroup::OPERATION_NAME_GET_COMPANY_OFFICES])]
    private $name;

    #[ORM\ManyToOne(targetEntity: CompanyGroup::class, inversedBy: 'companyEntities', cascade: ['persist'])]
    private $companyGroup;

    #[ORM\ManyToMany(targetEntity: Employer::class)]
    private $admins;

    #[ORM\OneToMany(mappedBy: 'companyEntity', targetEntity: CompanyEntityOffice::class, cascade: ['persist', 'remove'])]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS])]
    private Collection $companyEntityOffices;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?CompanyProfile $profile = null;

    #[ORM\OneToMany(mappedBy: 'companyEntity', targetEntity: CompanyEntityHasMedia::class, orphanRemoval: true)]
    private Collection $companyEntityMedias;

    public function __construct()
    {
        $this->admins = new ArrayCollection();
        $this->companyEntityOffices = new ArrayCollection();
        $this->companyEntityMedias = new ArrayCollection();
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
     * @return Collection<int, CompanyEntityHasMedia>
     */
    public function getCompanyEntityMedias(): Collection
    {
        return $this->companyEntityMedias;
    }

    public function addCompanyEntityMedia(CompanyEntityHasMedia $companyEntityMedia): self
    {
        if (!$this->companyEntityMedias->contains($companyEntityMedia)) {
            $this->companyEntityMedias->add($companyEntityMedia);
            $companyEntityMedia->setCompanyEntity($this);
        }

        return $this;
    }

    public function removeCompanyEntityMedia(CompanyEntityHasMedia $companyEntityMedia): self
    {
        if ($this->companyEntityMedias->removeElement($companyEntityMedia)) {
            // set the owning side to null (unless already changed)
            if ($companyEntityMedia->getCompanyEntity() === $this) {
                $companyEntityMedia->setCompanyEntity(null);
            }
        }

        return $this;
    }
}
