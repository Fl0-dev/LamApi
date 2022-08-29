<?php

namespace App\DataFixtures;

use App\Entity\Badge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BadgeFixtures extends Fixture
{
    public const BADGE_REFERENCE_1 = 'badge1';
    public const BADGE_REFERENCE_2 = 'badge2';
    public const BADGE_REFERENCE_3 = 'badge3';
    public const BADGE_REFERENCE_4 = 'badge4';
    public const BADGE_REFERENCE_5 = 'badge5';
    public const BADGE_REFERENCE_6 = 'badge6';
    public const BADGE_REFERENCE_7 = 'badge7';
    public const BADGE_REFERENCE_8 = 'badge8';
    public const BADGE_REFERENCE_9 = 'badge9';
    public const BADGE_REFERENCE_10 = 'badge10';

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

    public function load(ObjectManager $manager)
    {
        $badge = new Badge();
        $badge->setLabel('Cabinet à impact +');
        $badge->setImageUri('impact-plus.svg');
        $badge->setBadgePath('/assets/images/badges/' . 'impact-plus.svg');
        $badge->setDescription("Un cabinet peut choisir ce badge s'il a mis en place des actions concrètes pour avoir un impact positif sur l'environnement. Par exemple In Extenso Ouest Atlantique dispose de ruches installées sur le toit de leurs bureaux à Ancenis.");
        $badge->setSlug('impact-plus');
        $manager->persist($badge);
        $this->addReference(self::BADGE_REFERENCE_1, $badge);

        $badge = new Badge();
        $badge->setLabel('Café et thé illimité');
        $badge->setImageUri('cafe-et-the-illimite.svg');
        $badge->setBadgePath('/assets/images/badges/' . 'cafe-et-the-illimite.svg');
        $badge->setDescription("Si le cabinet propose des boissons/collations gratuitement, et en illimité, il peut choisir ce badge !");
        $badge->setSlug('cafe-et-the-illimite');
        $manager->persist($badge);
        $this->addReference(self::BADGE_REFERENCE_2, $badge);

        $badge = new Badge();
        $badge->setLabel('Equilibre vie pro/perso');
        $badge->setImageUri('equilibre-vie-pro-vie-perso.svg');
        $badge->setBadgePath('/assets/images/badges/' . 'equilibre-vie-pro-vie-perso.svg');
        $badge->setDescription("Pour avoir ce badge, le cabinet doit avoir mis en place des actions concrètes pour respecter l'équilibre entre la vie pro et la vie perso de ses collaborateurs, comme par exemple imposer des horaires de travail max, proposer de rattraper ses heures, de laisser les collaborateurs gérer des problématiques persos sans pour autant être tatillon (laisser aller chercher son enfant si besoin etc).");
        $badge->setSlug('equilibre-vie-pro-vie-perso');
        $manager->persist($badge);
        $this->addReference(self::BADGE_REFERENCE_3, $badge);

        $badge = new Badge();
        $badge->setLabel('Home office possible');
        $badge->setImageUri('home-office.svg');
        $badge->setBadgePath('/assets/images/badges/' . 'home-office.svg');
        $badge->setDescription("Si le cabinet a mis en place toutes les dispositions nécessaires pour faciliter le travail à domicile (télétravail), il peut disposer de ce badge.");
        $badge->setSlug('home-office');
        $manager->persist($badge);
        $this->addReference(self::BADGE_REFERENCE_4, $badge);

        $badge = new Badge();
        $badge->setLabel('Horaires flexibles');
        $badge->setImageUri('horaires-flexibles.svg');
        $badge->setBadgePath('/assets/images/badges/' . 'horaires-flexibles.svg');
        $badge->setDescription("Le cabinet peut avoir ce badge s'il laisse la possibilité à ses collaborateurs d'adapter les horaires, permettant ainsi à ces derniers de pouvoir s'organiser de manière plus flexible et selon leurs propres contraintes.");
        $badge->setSlug('horaires-flexibles');
        $manager->persist($badge);
        $this->addReference(self::BADGE_REFERENCE_5, $badge);

        $badge = new Badge();
        $badge->setLabel('Horaires flexibles');
        $badge->setImageUri('horaires-flexibles.svg');
        $badge->setBadgePath('/assets/images/badges/' . 'horaires-flexibles.svg');
        $badge->setDescription("Le cabinet peut avoir ce badge s'il laisse la possibilité à ses collaborateurs d'adapter les horaires, permettant ainsi à ces derniers de pouvoir s'organiser de manière plus flexible et selon leurs propres contraintes.");
        $badge->setSlug('international');
        $manager->persist($badge);
        $this->addReference(self::BADGE_REFERENCE_6, $badge);

        $badge = new Badge();
        $badge->setLabel('No costume');
        $badge->setImageUri('no-costume.svg');
        $badge->setBadgePath('/assets/images/badges/' . 'no-costume.svg');
        $badge->setDescription("Lorsque le cabinet n'impose pas de venir travailler en costume (à part pour les réunions client), il peut avoir ce badge !");
        $badge->setSlug('no-costume');
        $manager->persist($badge);
        $this->addReference(self::BADGE_REFERENCE_7, $badge);

        $badge = new Badge();
        $badge->setLabel('Ouvert aux stages et alternances');
        $badge->setImageUri('stage-alternance.svg');
        $badge->setBadgePath('/assets/images/badges/' . 'stage-alternance.svg');
        $badge->setDescription("Pour avoir ce badge il faut que le cabinet soit ouvert à l'embauche de stagiaires et alternants
            Note : il s'agit d'un badge « bonus » pour les Packs débutant (qui peuvent donc avoir ce badge en plus d'un autre, ceci afin d'encourager les cabinets à embaucher des stagiaires et alternants qui ont déjà du mal à trouver un cabinet).");
        $badge->setSlug('stage-alternance');
        $manager->persist($badge);
        $this->addReference(self::BADGE_REFERENCE_8, $badge);

        $badge = new Badge();
        $badge->setLabel('Sport');
        $badge->setImageUri('sport.svg');
        $badge->setBadgePath('/assets/images/badges/' . 'sport.svg');
        $badge->setDescription("Si le cabinet a mis à disposition des aménagements (douches, salles, machines…) pour favoriser le sport sur le lieu de travail, il peut avoir ce badge.");
        $badge->setSlug('sport');
        $manager->persist($badge);
        $this->addReference(self::BADGE_REFERENCE_9, $badge);

        $badge = new Badge();
        $badge->setLabel('Stage DEC');
        $badge->setImageUri('stage-dec.svg');
        $badge->setBadgePath('/assets/images/badges/' . 'stage-dec.svg');
        $badge->setDescription("Le cabinet propose de prendre des stagiaires pour l'obtention du DEC (Diplôme d'Expert-Comptable).");
        $badge->setSlug('stage-dec');
        $manager->persist($badge);
        $this->addReference(self::BADGE_REFERENCE_10, $badge);

        $manager->flush();
    }
}
