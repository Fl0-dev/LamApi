<?php

namespace App\Repository\ReferencesRepositories;

use App\Entity\References\OrganisationType;
use App\Utils\Utils;

class OrganisationTypeRepository
{
    /**
     * @return OrganisationType[]
     */
    public function findAll(): array
    {
        $organisationTypes = [];
        $arrayOrganisationTypes = OrganisationType::ORGANISATION_TYPES;

        if (is_array($arrayOrganisationTypes)) {
            foreach ($arrayOrganisationTypes as $organisationType) {
                $organisationTypes[] = new OrganisationType(
                    Utils::getArrayValue('slug', $organisationType),
                    Utils::getArrayValue('label', $organisationType)
                );
            }
        }

        return $organisationTypes;
    }

    public function find(string $id): ?OrganisationType
    {
        $organisationTypes = $this->findAll();

        foreach ($organisationTypes as $organisationType) {
            if ($organisationType->getId() === $id) {
                return $organisationType;
            }
        }

        return null;
    }
}
