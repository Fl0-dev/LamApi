<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Subscriptions\Employer\Lamatch\EmployerFavoriteCandidat;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity]
#[ORM\Table(name: "employer")]
class Employer extends UserPhysical
{
    #[ORM\OneToMany(mappedBy: 'employer', targetEntity: EmployerFavoriteCandidat::class)]
    private Collection $employerFavoriteCandidats;

    public function __construct()
    {
        parent::__construct();
        $this->employerFavoriteCandidats = new ArrayCollection();
    }

    public function getPhysicalType(): string
    {
        return self::TYPE_EMPLOYER;
    }

    /**
     * @return Collection<int, EmployerFavoriteCandidat>
     */
    public function getEmployerFavoriteCandidats(): Collection
    {
        return $this->employerFavoriteCandidats;
    }

    public function addEmployerFavoriteCandidat(EmployerFavoriteCandidat $employerFavoriteCandidat): self
    {
        if (!$this->employerFavoriteCandidats->contains($employerFavoriteCandidat)) {
            $this->employerFavoriteCandidats->add($employerFavoriteCandidat);
            $employerFavoriteCandidat->setEmployer($this);
        }

        return $this;
    }

    public function removeEmployerFavoriteCandidat(EmployerFavoriteCandidat $employerFavoriteCandidat): self
    {
        if ($this->employerFavoriteCandidats->removeElement($employerFavoriteCandidat)) {
            // set the owning side to null (unless already changed)
            if ($employerFavoriteCandidat->getEmployer() === $this) {
                $employerFavoriteCandidat->setEmployer(null);
            }
        }

        return $this;
    }
}
