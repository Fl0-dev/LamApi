<?php

namespace App\Entity\User;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource()]
class UserApi extends UserAbstract
{

    #[ORM\Column(type: "string", length: 255)]
    private $tokenLocal;

    #[ORM\Column(type: "string", length: 255)]
    private $tokenQualification;

    #[ORM\Column(type: "string", length: 255)]
    private $tokenProduction;

    /**
     * Get the value of tokenLocal
     */ 
    public function getTokenLocal()
    {
        return $this->tokenLocal;
    }

    /**
     * Set the value of tokenLocal
     *
     * @return  self
     */ 
    public function setTokenLocal($tokenLocal)
    {
        $this->tokenLocal = $tokenLocal;

        return $this;
    }

    /**
     * Get the value of tokenQualification
     */ 
    public function getTokenQualification()
    {
        return $this->tokenQualification;
    }

    /**
     * Set the value of tokenQualification
     *
     * @return  self
     */ 
    public function setTokenQualification($tokenQualification)
    {
        $this->tokenQualification = $tokenQualification;

        return $this;
    }

    /**
     * Get the value of tokenProduction
     */ 
    public function getTokenProduction()
    {
        return $this->tokenProduction;
    }

    /**
     * Set the value of tokenProduction
     *
     * @return  self
     */ 
    public function setTokenProduction($tokenProduction)
    {
        $this->tokenProduction = $tokenProduction;

        return $this;
    }
}