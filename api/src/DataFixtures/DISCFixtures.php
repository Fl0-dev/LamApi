<?php

namespace App\DataFixtures;

use App\Entity\Subscriptions\DISC\DISCPersonality;
use App\Entity\Subscriptions\DISC\DISCQuality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DISCFixtures extends Fixture
{
    public const DISC_PERSONALITY_DOMINANT = 'disc_personality_dominant';
    public const DISC_PERSONALITY_INFLUENTIAL = 'disc_personality_influential';
    public const DISC_PERSONALITY_STEADY = 'disc_personality_steady';
    public const DISC_PERSONALITY_CONSCIENTIOUS = 'disc_personality_conscientious';

    public const DISC_QUALITY_DOMINANT_1 = 'disc_quality_dominant_1';
    public const DISC_QUALITY_DOMINANT_2 = 'disc_quality_dominant_2';
    public const DISC_QUALITY_DOMINANT_3 = 'disc_quality_dominant_3';
    public const DISC_QUALITY_DOMINANT_4 = 'disc_quality_dominant_4';
    public const DISC_QUALITY_DOMINANT_5 = 'disc_quality_dominant_5';

    public const DISC_QUALITY_INFLUENTIAL_1 = 'disc_quality_influential_1';
    public const DISC_QUALITY_INFLUENTIAL_2 = 'disc_quality_influential_2';
    public const DISC_QUALITY_INFLUENTIAL_3 = 'disc_quality_influential_3';
    public const DISC_QUALITY_INFLUENTIAL_4 = 'disc_quality_influential_4';
    public const DISC_QUALITY_INFLUENTIAL_5 = 'disc_quality_influential_5';

    public const DISC_QUALITY_STEADY_1 = 'disc_quality_steady_1';
    public const DISC_QUALITY_STEADY_2 = 'disc_quality_steady_2';
    public const DISC_QUALITY_STEADY_3 = 'disc_quality_steady_3';
    public const DISC_QUALITY_STEADY_4 = 'disc_quality_steady_4';
    public const DISC_QUALITY_STEADY_5 = 'disc_quality_steady_5';

    public const DISC_QUALITY_CONSCIENTIOUS_1 = 'disc_quality_conscientious_1';
    public const DISC_QUALITY_CONSCIENTIOUS_2 = 'disc_quality_conscientious_2';
    public const DISC_QUALITY_CONSCIENTIOUS_3 = 'disc_quality_conscientious_3';
    public const DISC_QUALITY_CONSCIENTIOUS_4 = 'disc_quality_conscientious_4';
    public const DISC_QUALITY_CONSCIENTIOUS_5 = 'disc_quality_conscientious_5';

    public function load(ObjectManager $manager): void
    {
        $personality = new DISCPersonality();
        $personality->setSlug('dominant');
        $personality->setLabel('Dominant');
        $personality->setColor('red');
        $this->addReference(self::DISC_PERSONALITY_DOMINANT, $personality);
        $manager->persist($personality);

        $quality = new DISCQuality();
        $quality->setSlug('direct');
        $quality->setLabel('Direct');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_DOMINANT_1, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('strong-willed');
        $quality->setLabel('Volontaire');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_DOMINANT_2, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('firm');
        $quality->setLabel('Solide');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_DOMINANT_3, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('forceful');
        $quality->setLabel('Energique');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_DOMINANT_4, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('results-oriented');
        $quality->setLabel('Axé sur les résultats');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_DOMINANT_5, $quality);
        $manager->persist($quality);

        $manager->flush();

        $personality = new DISCPersonality();
        $personality->setSlug('influential');
        $personality->setLabel('Influent');
        $personality->setColor('yellow');
        $this->addReference(self::DISC_PERSONALITY_INFLUENTIAL, $personality);
        $manager->persist($personality);

        $quality = new DISCQuality();
        $quality->setSlug('outgoing');
        $quality->setLabel('Ouvert');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_INFLUENTIAL_1, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('enthusiastic');
        $quality->setLabel('Enthousiaste');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_INFLUENTIAL_2, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('optimistic');
        $quality->setLabel('Optimiste');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_INFLUENTIAL_3, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('high-spirited');
        $quality->setLabel('Passionné');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_INFLUENTIAL_4, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('lively');
        $quality->setLabel('Animé');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_INFLUENTIAL_5, $quality);
        $manager->persist($quality);

        $manager->flush();

        $personality = new DISCPersonality();
        $personality->setSlug('steady');
        $personality->setLabel('Stable');
        $personality->setColor('green');
        $this->addReference(self::DISC_PERSONALITY_STEADY, $personality);
        $manager->persist($personality);

        $quality = new DISCQuality();
        $quality->setSlug('even-tempered');
        $quality->setLabel('Calme');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_STEADY_1, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('accommodating');
        $quality->setLabel('Accommodant');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_STEADY_2, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('patient');
        $quality->setLabel('Patient');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_STEADY_3, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('humble');
        $quality->setLabel('Modeste');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_STEADY_4, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('tactful');
        $quality->setLabel('Diplomate');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_STEADY_5, $quality);
        $manager->persist($quality);

        $manager->flush();

        $personality = new DISCPersonality();
        $personality->setSlug('conscientious');
        $personality->setLabel('Consciencieux');
        $personality->setColor('blue');
        $this->addReference(self::DISC_PERSONALITY_CONSCIENTIOUS, $personality);
        $manager->persist($personality);

        $quality = new DISCQuality();
        $quality->setSlug('reserved');
        $quality->setLabel('Réservé');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_CONSCIENTIOUS_1, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('precise');
        $quality->setLabel('Précis');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_CONSCIENTIOUS_2, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('organized');
        $quality->setLabel('Organisé');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_CONSCIENTIOUS_3, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('analytical');
        $quality->setLabel('Analytique');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_CONSCIENTIOUS_4, $quality);
        $manager->persist($quality);

        $quality = new DISCQuality();
        $quality->setSlug('focused');
        $quality->setLabel('Concentré');
        $quality->setPersonality($personality);
        $this->addReference(self::DISC_QUALITY_CONSCIENTIOUS_5, $quality);
        $manager->persist($quality);

        $manager->flush();
    }
}
