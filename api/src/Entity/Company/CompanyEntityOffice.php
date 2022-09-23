<?php

namespace App\Entity\Company;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Application\Application;
use App\Entity\JobBoard;
use App\Entity\Location\Address;
use App\Entity\Offer\Offer;
use App\Repository\CompanyRepositories\CompanyEntityOfficeRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid as BaseUuid;

#[ORM\Entity(repositoryClass: CompanyEntityOfficeRepository::class)]
#[ApiResource()]
class CompanyEntityOffice
{
    use Uuid;
    use Slug;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        Offer::OPERATION_NAME_GET_OFFER_DETAILS,
        Offer::OPERATION_NAME_GET_OFFER_TEASERS,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS,
    ])]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_TEASERS,
        Offer::OPERATION_NAME_GET_OFFER_DETAILS,
        Offer::OPERATION_NAME_GET_OFFER_TEASERS,
        CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS,
        CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID
    ])]
    private ?Address $address = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_OFFICES_BY_COMPANY_GROUP_ID])]
    private $hrMailAddress;

    #[ORM\ManyToOne(inversedBy: 'companyEntityOffices', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        Offer::OPERATION_NAME_GET_OFFER_DETAILS,
        Offer::OPERATION_NAME_GET_OFFER_TEASERS,
        JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS
    ])]
    private ?CompanyEntity $companyEntity = null;

    #[ORM\OneToMany(mappedBy: 'companyEntityOffice', targetEntity: Offer::class)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_OFFERS_BY_COMPANY_GROUP_ID])]
    private Collection $offers;

    #[ORM\OneToMany(mappedBy: 'companyEntityOffice', targetEntity: Application::class)]
    #[Groups([CompanyGroup::OPERATION_NAME_GET_APPLICATIONS_BY_COMPANY_GROUP_ID])]
    private Collection $applications;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->applications = new ArrayCollection();
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

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCompanyEntity(): ?CompanyEntity
    {
        return $this->companyEntity;
    }

    public function setCompanyEntity(?CompanyEntity $companyEntity): self
    {
        $this->companyEntity = $companyEntity;

        return $this;
    }

    public function getHrMailAddress(): ?string
    {
        return $this->hrMailAddress;
    }

    public function setHrMailAddress(string $hrMailAddress): self
    {
        $this->hrMailAddress = $hrMailAddress;

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
            $this->offers->add($offer);
            $offer->setCompanyEntityOffice($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getCompanyEntityOffice() === $this) {
                $offer->setCompanyEntityOffice(null);
            }
        }

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
            $this->applications->add($application);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getCompanyEntityOffice() === $this) {
                $application->setCompanyEntityOffice(null);
            }
        }

        return $this;
    }
}
