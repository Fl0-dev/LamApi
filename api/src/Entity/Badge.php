<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Company\CompanyGroup;
use App\Repository\BadgeRepository;
use App\Transversal\Label;
use App\Transversal\Slug;
use App\Transversal\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BadgeRepository::class)]
#[ApiResource()]
#[ApiFilter(SearchFilter::class, properties: ['slug' => 'ipartial'])]
class Badge
{
    const ID_LABEL = 'label';
    const ID_FILENAME = 'image-uri';
    const ID_DESCRIPTION = 'description';
    const BADGE_IMAGE_ROOT_PATH = '/assets/images/badges/';

    const BADGES = [
        'impact-plus' => [
            self::ID_LABEL => 'Cabinet à impact +',
            self::ID_FILENAME => 'impact-plus.svg',
            self::ID_DESCRIPTION => "Un cabinet peut choisir ce badge s'il a mis en place des actions concrètes pour avoir un impact positif sur l'environnement. Par exemple In Extenso Ouest Atlantique dispose de ruches installées sur le toit de leurs bureaux à Ancenis."
        ],
        'cafe-et-the-illimite' => [
            self::ID_LABEL => 'Café et thé illimité',
            self::ID_FILENAME => 'cafe-et-the-illimite.svg',
            self::ID_DESCRIPTION => "Si le cabinet propose des boissons/collations gratuitement, et en illimité, il peut choisir ce badge !"
        ],
        'equilibre-vie-pro-vie-perso' => [
            self::ID_LABEL => 'Equilibre vie pro/perso',
            self::ID_FILENAME => 'equilibre-vie-pro-vie-perso.svg',
            self::ID_DESCRIPTION => "Pour avoir ce badge, le cabinet doit avoir mis en place des actions concrètes pour respecter l'équilibre entre la vie pro et la vie perso de ses collaborateurs, comme par exemple imposer des horaires de travail max, proposer de rattraper ses heures, de laisser les collaborateurs gérer des problématiques persos sans pour autant être tatillon (laisser aller chercher son enfant si besoin etc)."
        ],
        'home-office' => [
            self::ID_LABEL => 'Home office possible',
            self::ID_FILENAME => 'home-office.svg',
            self::ID_DESCRIPTION => "Si le cabinet a mis en place toutes les dispositions nécessaires pour faciliter le travail à domicile (télétravail), il peut disposer de ce badge."
        ],
        'horaires-flexibles' => [
            self::ID_LABEL => 'Horaires flexibles',
            self::ID_FILENAME => 'horaires-flexibles.svg',
            self::ID_DESCRIPTION => "Le cabinet peut avoir ce badge s'il laisse la possibilité à ses collaborateurs d'adapter les horaires, permettant ainsi à ces derniers de pouvoir s'organiser de manière plus flexible et selon leurs propres contraintes."
        ],
        'international' => [
            self::ID_LABEL => 'International',
            self::ID_FILENAME => 'international.svg',
            self::ID_DESCRIPTION => "Le cabinet peut avoir ce badge s'il dispose de bureau à l'international ou s'il travaille avec des clients à l'international."
        ],
        'no-costume' => [
            self::ID_LABEL => 'No costume',
            self::ID_FILENAME => 'no-costume.svg',
            self::ID_DESCRIPTION => "Lorsque le cabinet n'impose pas de venir travailler en costume (à part pour les réunions client), il peut avoir ce badge !"
        ],
        'stage-alternance' => [
            self::ID_LABEL => 'Ouvert aux stages et alternances',
            self::ID_FILENAME => 'stage-alternance.svg',
            self::ID_DESCRIPTION => "Pour avoir ce badge il faut que le cabinet soit ouvert à l'embauche de stagiaires et alternants
            Note : il s'agit d'un badge « bonus » pour les Packs débutant (qui peuvent donc avoir ce badge en plus d'un autre, ceci afin d'encourager les cabinets à embaucher des stagiaires et alternants qui ont déjà du mal à trouver un cabinet)."
        ],
        'sport' => [
            self::ID_LABEL => 'Sport',
            self::ID_FILENAME => 'sport.svg',
            self::ID_DESCRIPTION => "Si le cabinet a mis à disposition des aménagements (douches, salles, machines…) pour favoriser le sport sur le lieu de travail, il peut avoir ce badge."
        ],
        'stage-dec' => [
            self::ID_LABEL => 'Stage DEC',
            self::ID_FILENAME => 'stage-dec.svg',
            self::ID_DESCRIPTION => "Le cabinet propose de prendre des stagiaires pour l'obtention du DEC (Diplôme d'Expert-Comptable)."
        ],
    ];

    use Uuid;
    use Label;
    use Slug;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imageUri;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[Groups([CompanyGroup::OPERATION_NAME_GET_COMPANY_GROUP_DETAILS])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $badgePath;

    /**
     * Check if the given $badge is a valid Badge
     */
    public static function isBadge($badge): bool
    {
        return $badge instanceof self && $badge->hasSlug();
    }

    /**
     * Check if the given $badges array contains only valid Badge
     */
    public static function areBadges(ArrayCollection|array $badges): bool
    {
        $isOk = false;

        if ($badges instanceof ArrayCollection) {
            $badges = $badges->toArray();
        }

        if (is_array($badges)) {
            $isOk = true;

            foreach ($badges as $badge) {
                if (!self::isBadge($badge)) {
                    $isOk = false;
                }
            }
        }

        return $isOk;
    }

    public function getImageUri(): ?string
    {
        return $this->imageUri;
    }

    public function setImageUri(?string $imageUri): self
    {
        $this->imageUri = $imageUri;

        return $this;
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

    public function getBadgePath(): ?string
    {
        return $this->badgePath;
    }

    public function setBadgePath(?string $badgePath): self
    {
        $this->badgePath = $badgePath;

        return $this;
    }
}
