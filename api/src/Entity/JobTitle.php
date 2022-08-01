<?php

namespace App\Entity;

use App\Repository\JobTitleRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobTitleRepository::class)]
class JobTitle
{
    use Uuid;
    use Slug;
    use Label;

    #[ORM\ManyToMany(targetEntity: JobType::class)]
    private $jobTypes;

    public function __construct()
    {
        $this->jobTypes = new ArrayCollection();
    }

    /**
     * @return Collection<int, JobType>
     */
    public function getJobTypes(): Collection
    {
        return $this->jobTypes;
    }

    public function addJobType(JobType $jobType): self
    {
        if (!$this->jobTypes->contains($jobType)) {
            $this->jobTypes[] = $jobType;
        }

        return $this;
    }

    public function removeJobType(JobType $jobType): self
    {
        $this->jobTypes->removeElement($jobType);

        return $this;
    }
}
