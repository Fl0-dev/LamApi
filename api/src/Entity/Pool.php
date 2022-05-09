<?php

namespace App\Entity;

use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pool (Company grouping with other organisations/companies...)
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *      "pool" = "Pool"
 * })
 */
class Pool extends Organisation
{
    use Uuid;

    /**
     * Constructor
     */
    public function __construct()
    {
    }
}
