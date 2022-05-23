<?php

namespace App\Transversal;

use App\Transversal\CreatedDate;
use App\Transversal\LastModifiedDate;
use App\Transversal\Slug;
use App\Transversal\Uuid;

/**
 * Trait for Technical Properties
 */
trait TechnicalProperties
{
    use Uuid;
    use Slug;
    use CreatedDate;
    use LastModifiedDate;
}
