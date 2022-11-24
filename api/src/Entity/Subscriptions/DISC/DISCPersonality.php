<?php

namespace App\Entity\Subscriptions\DISC;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubscriptionRepositories\DISC\DISCPersonalityRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use App\Utils\Utils;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DISCPersonalityRepository::class)]
#[ApiResource]
class DISCPersonality
{
    use Uuid;
    use Label;
    use Slug;

    #[ORM\Column(length: 6)]
    private ?string $color = null;

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public static function getPersonalityPercentagesByQualities($qualities): array
    {
        $personalities = [];
        $numberOfApplicantQualities = count($qualities);
        $personalities['Dominant'] = 0;
        $personalities['Influent'] = 0;
        $personalities['Stable'] = 0;
        $personalities['Consciencieux'] = 0;
        foreach ($qualities as $quality) {
            $qual[] = $quality->getLabel();
            $personalities[$quality->getPersonality()->getLabel()] =
                (int) Utils::getArrayValue($quality->getPersonality()->getLabel(), $personalities) + 1;
        }

        foreach ($personalities as $key => $value) {
            $personalities[$key] = (int) ($value * 100 / $numberOfApplicantQualities);
        }
        return $personalities;
    }

    public static function getPersonalityPercentagesByPersonalities($personalities): array
    {
        $personalityPercentages = [];
        $numberOfApplicantPersonalities = count($personalities);
        $personalityPercentages['Dominant'] = 0;
        $personalityPercentages['Influent'] = 0;
        $personalityPercentages['Stable'] = 0;
        $personalityPercentages['Consciencieux'] = 0;

        foreach ($personalities as $personality) {
            $personalityPercentages[$personality->getLabel()] =
                (int) Utils::getArrayValue($personality->getLabel(), $personalityPercentages) + 1;
        }

        foreach ($personalityPercentages as $key => $value) {
            $personalityPercentages[$key] = $value * 100 / $numberOfApplicantPersonalities;
        }

        return $personalityPercentages;
    }
}
