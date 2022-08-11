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
    #[Groups(['read:getOfferDetails'])]
    private $hrMail;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $officeNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(["read:getAllCompanyGroups"])]
    private $name;

    #[ORM\ManyToOne(targetEntity: CompanyGroup::class, inversedBy: 'companyEntities')]
    private $companyGroup;

    #[ORM\ManyToMany(targetEntity: Address::class, cascade: ['persist'])]
    //#[ORM\JoinTable(name: "company_entity_offices")]
    #[Groups(["read:getAllCompanyGroups", "read:getAllTeaserCompanyGroups",'read:getOfferDetails', 'read:getAllTeaserOffers'])]
    private $addresses;

    #[ORM\ManyToMany(targetEntity: Employer::class)]
    private $admins;

    #[ORM\OneToMany(mappedBy: 'companyEntity', targetEntity: Application::class)]
    private $applications;

    #[ORM\OneToMany(mappedBy: 'companyEntity', targetEntity: Offer::class)]
    #[Groups(["read:getAllCompanyGroups"])]
    private $offers;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->admins = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->offers = new ArrayCollection();
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
     * @return Collection<int, Address>
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        $this->addresses->removeElement($address);

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
}
