<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Company\Group\CompanyGroupBadge;
use App\Transversal\TechnicalProperties;
use Doctrine\Common\Collections\ArrayCollection;

use function PHPSTORM_META\type;

/**
 * CompanyEntity Badge
 */
#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
#[ORM\Entity(repositoryClass: BadgeRepository::class)]
class Badge
{
    // const ID_LABEL = 'label';
    // const ID_FILENAME = 'image-uri';
    // const ID_DESCRIPTION = 'description';
    // const BADGE_IMAGE_ROOT_PATH = '/assets/images/badges/';

    // const BADGES = [
    //     'impact-plus' => [
    //         self::ID_LABEL => 'Cabinet à impact +',
    //         self::ID_FILENAME => 'impact-plus.svg',
    //         self::ID_DESCRIPTION => "Un cabinet peut choisir ce badge s'il a mis en place des actions concrètes pour avoir un impact positif sur l'environnement. Par exemple In Extenso Ouest Atlantique dispose de ruches installées sur le toit de leurs bureaux à Ancenis."
    //     ],
    //     'cafe-et-the-illimite' => [
    //         self::ID_LABEL => 'Café et thé illimité',
    //         self::ID_FILENAME => 'cafe-et-the-illimite.svg',
    //         self::ID_DESCRIPTION => "Si le cabinet propose des boissons/collations gratuitement, et en illimité, il peut choisir ce badge !"
    //     ],
    //     'equilibre-vie-pro-vie-perso' => [
    //         self::ID_LABEL => 'Equilibre vie pro/perso',
    //         self::ID_FILENAME => 'equilibre-vie-pro-vie-perso.svg',
    //         self::ID_DESCRIPTION => "Pour avoir ce badge, le cabinet doit avoir mis en place des actions concrètes pour respecter l'équilibre entre la vie pro et la vie perso de ses collaborateurs, comme par exemple imposer des horaires de travail max, proposer de rattraper ses heures, de laisser les collaborateurs gérer des problématiques persos sans pour autant être tatillon (laisser aller chercher son enfant si besoin etc)."
    //     ],
    //     'home-office' => [
    //         self::ID_LABEL => 'Home office possible',
    //         self::ID_FILENAME => 'home-office.svg',
    //         self::ID_DESCRIPTION => "Si le cabinet a mis en place toutes les dispositions nécessaires pour faciliter le travail à domicile (télétravail), il peut disposer de ce badge."
    //     ],
    //     'horaires-flexibles' => [
    //         self::ID_LABEL => 'Horaires flexibles',
    //         self::ID_FILENAME => 'horaires-flexibles.svg',
    //         self::ID_DESCRIPTION => "Le cabinet peut avoir ce badge s'il laisse la possibilité à ses collaborateurs d'adapter les horaires, permettant ainsi à ces derniers de pouvoir s'organiser de manière plus flexible et selon leurs propres contraintes."
    //     ],
    //     'international' => [
    //         self::ID_LABEL => 'International',
    //         self::ID_FILENAME => 'international.svg',
    //         self::ID_DESCRIPTION => "Le cabinet peut avoir ce badge s'il dispose de bureau à l'international ou s'il travaille avec des clients à l'international."
    //     ],
    //     'no-costume' => [
    //         self::ID_LABEL => 'No costume',
    //         self::ID_FILENAME => 'no-costume.svg',
    //         self::ID_DESCRIPTION => "Lorsque le cabinet n'impose pas de venir travailler en costume (à part pour les réunions client), il peut avoir ce badge !"
    //     ],
    //     'stage-alternance' => [
    //         self::ID_LABEL => 'Ouvert aux stages et alternances',
    //         self::ID_FILENAME => 'stage-alternance.svg',
    //         self::ID_DESCRIPTION => "Pour avoir ce badge il faut que le cabinet soit ouvert à l'embauche de stagiaires et alternants
    //         Note : il s'agit d'un badge « bonus » pour les Packs débutant (qui peuvent donc avoir ce badge en plus d'un autre, ceci afin d'encourager les cabinets à embaucher des stagiaires et alternants qui ont déjà du mal à trouver un cabinet)."
    //     ],
    //     'sport' => [
    //         self::ID_LABEL => 'Sport',
    //         self::ID_FILENAME => 'sport.svg',
    //         self::ID_DESCRIPTION => "Si le cabinet a mis à disposition des aménagements (douches, salles, machines…) pour favoriser le sport sur le lieu de travail, il peut avoir ce badge."
    //     ],
    //     'stage-dec' => [
    //         self::ID_LABEL => 'Stage DEC',
    //         self::ID_FILENAME => 'stage-dec.svg',
    //         self::ID_DESCRIPTION => "Le cabinet propose de prendre des stagiaires pour l'obtention du DEC (Diplôme d'Expert-Comptable)."
    //     ],
    // ];

    use TechnicalProperties;

    #[ORM\Column(type: "string")]
    private ?string $label = null;

    #[ORM\Column(type: "string")]
    private ?string $imageUri = null;

    #[ORM\Column(type: "text")]
    private ?string $description = null;

    #[ORM\Column(type: "string")]
    private ?string $badgePath = null;

    #[ORM\OneToMany(targetEntity: CompanyGroupBadge::class, mappedBy: "badge")]
    private $companyGroups;
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    public function __toString()
    {
        return $this->getSlug();
    }

    /**
     * Get the value of label
     */ 
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the value of label
     *
     * @return  self
     */ 
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

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

    /**
     * Get the value of imageUri
     */ 
    public function getImageUri()
    {
        return $this->imageUri;
    }

    /**
     * Set the value of imageUri
     *
     * @return  self
     */ 
    public function setImageUri($imageUri)
    {
        $this->imageUri = $imageUri;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of badgePath
     */ 
    public function getBadgePath()
    {
        return $this->badgePath;
    }

    /**
     * Set the value of badgePath
     *
     * @return  self
     */ 
    public function setBadgePath($badgePath)
    {
        $this->badgePath = $badgePath;

        return $this;
    }

    /**
     * Get the value of companyGroups
     */ 
    public function getCompanyGroups()
    {
        return $this->companyGroups;
    }

    /**
     * Set the value of companyGroups
     *
     * @return  self
     */ 
    public function setCompanyGroups($companyGroups)
    {
        $this->companyGroups = $companyGroups;

        return $this;
    }
}
