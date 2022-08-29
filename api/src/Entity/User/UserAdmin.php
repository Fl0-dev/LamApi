<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Admin_Users")]
class UserAdmin extends UserPhysical
{
    #[ORM\Column(type: "string")]
    private $level;


    /**
     * Get the value of level
     */ 
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set the value of level
     *
     * @return  self
     */ 
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }
}

