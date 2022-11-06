<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ExpertiseFieldRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpertiseFieldRepository::class)]
#[ApiResource]
class ExpertiseField
{
    use Uuid;
    use Slug;
    use Label;

    public const EXPERTISE_FIELDS = [
        'agricole' => 'Agricole',
        'agroalimentaire' => 'Agroalimentaire',
        'automobile' => 'Automobile',
        'banque' => 'Banque',
        'btp' => 'BTP',
        'commerce' => 'Commerce',
        'communication' => 'Communication',
        'conseil' => 'Conseil',
        'distribution' => 'Distribution',
        'education' => 'Education',
        'energie' => 'Energie',
        'finance' => 'Finance',
        'industrie' => 'Industrie',
        'informatique' => 'Informatique',
        'immobilier' => 'Immobilier',
        'logistique' => 'Logistique',
        'medias' => 'Médias',
        'médical' => 'Médical',
        'pharmaceutique' => 'Pharmaceutique',
        'prestations-de-services' => 'Prestations de services',
        'public' => 'Public',
        'restauration' => 'Restauration',
        'sante' => 'Santé',
        'social' => 'Social',
        'sport' => 'Sport',
        'tourisme' => 'Tourisme',
        'transport' => 'Transport',
        'autre' => 'Autre'
    ];
}
