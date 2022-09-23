<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Offer\Offer;
use App\Repository\JobBoardRepository;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: JobBoardRepository::class)]
#[ApiResource(
    itemOperations: [
        self::OPERATION_NAME_GET_JOB_BOARD_OFFERS => [
            'method' => 'GET',
            'path' => '/job-boards/{id}/offers',
            'normalization_context' => [
                'groups' => [self::OPERATION_NAME_GET_JOB_BOARD_OFFERS]
            ],
            'formats' => [
                'json' => ['application/json'],
            ],
        ],
    ],
)]
class JobBoard
{
    const OPERATION_NAME_GET_JOB_BOARD_OFFERS = 'getJobBoardOffers';

    use Uuid;
    use Slug;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'boolean')]
    private $free;

    #[ORM\ManyToMany(targetEntity: Offer::class, mappedBy: 'jobBoards')]
    #[Groups([JobBoard::OPERATION_NAME_GET_JOB_BOARD_OFFERS])]
    private $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isFree(): ?bool
    {
        return $this->free;
    }

    public function setFree(bool $free): self
    {
        $this->free = $free;

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
            $offer->addJobBoard($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            $offer->removeJobBoard($this);
        }

        return $this;
    }
}
