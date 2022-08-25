<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompanyEntityOfficeRepository;
use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CompanyEntityOfficeRepository::class)]
#[ApiResource]
class CompanyEntityOffice
{
    use Uuid;
    use Slug;
    use CreatedDate;
    use LastModifiedDate;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:getOfferDetails', 'read:getAllTeaserOffers', "read:getJobBoardOffers", 'write:postOffer'])]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([ "read:getAllTeaserCompanyGroups",'read:getOfferDetails', 'read:getAllTeaserOffers', 'read:getCompanyGroupDetails', 'read:getCompanyGroupOffices'])]
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'companyEntityOffices')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['read:getOfferDetails', 'read:getAllTeaserOffers', "read:getJobBoardOffers", 'write:postOffer'])]
    private ?CompanyEntity $companyEntity = null;

    #[ORM\OneToMany(mappedBy: 'companyEntityOffice', targetEntity: Offer::class)]
    private Collection $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
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
}
