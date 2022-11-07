<?php

namespace App\DataFixtures;

use App\Entity\ExpertiseField;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpertiseFieldFixtures extends Fixture
{
    public const EXPERTISE_FIELD_AGRICOLE = 'agricole';
    public const EXPERTISE_FIELD_AGROALIMENTAIRE = 'agroalimentaire';
    public const EXPERTISE_FIELD_AUTOMOBILE = 'automobile';
    public const EXPERTISE_FIELD_BANQUE = 'banque';
    public const EXPERTISE_FIELD_BTP = 'btp';
    public const EXPERTISE_FIELD_COMMERCE = 'commerce';
    public const EXPERTISE_FIELD_COMMUNICATION = 'communication';
    public const EXPERTISE_FIELD_DISTRIBUTION = 'distribution';
    public const EXPERTISE_FIELD_EDUCATION = 'education';
    public const EXPERTISE_FIELD_ENERGIE = 'energie';
    public const EXPERTISE_FIELD_FINANCE = 'finance';
    public const EXPERTISE_FIELD_INDUSTRIE = 'industrie';
    public const EXPERTISE_FIELD_INFORMATIQUE = 'informatique';
    public const EXPERTISE_FIELD_IMMOBILIER = 'immobilier';
    public const EXPERTISE_FIELD_LOGISTIQUE = 'logistique';
    public const EXPERTISE_FIELD_MEDIAS = 'medias';
    public const EXPERTISE_FIELD_MEDICAL = 'medical';
    public const EXPERTISE_FIELD_PHARMACEUTIQUE = 'pharmaceutique';
    public const EXPERTISE_FIELD_PRESTATIONS_DE_SERVICES = 'prestations-de-services';
    public const EXPERTISE_FIELD_PUBLIC = 'public';
    public const EXPERTISE_FIELD_RESTAURATION = 'restauration';
    public const EXPERTISE_FIELD_SANTE = 'sante';
    public const EXPERTISE_FIELD_SOCIAL = 'social';
    public const EXPERTISE_FIELD_SPORT = 'sport';
    public const EXPERTISE_FIELD_TOURISME = 'tourisme';
    public const EXPERTISE_FIELD_TRANSPORT = 'transport';
    public const EXPERTISE_FIELD_AUTRE = 'autre';

    public function load(ObjectManager $manager)
    {
        $expertField = new ExpertiseField();
        $expertField->setLabel('Agricole');
        $expertField->setSlug('agricole');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_AGRICOLE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Agroalimentaire');
        $expertField->setSlug('agroalimentaire');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_AGROALIMENTAIRE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Automobile');
        $expertField->setSlug('automobile');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_AUTOMOBILE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Banque');
        $expertField->setSlug('banque');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_BANQUE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('BTP');
        $expertField->setSlug('btp');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_BTP, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Commerce');
        $expertField->setSlug('commerce');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_COMMERCE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Communication');
        $expertField->setSlug('communication');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_COMMUNICATION, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Distribution');
        $expertField->setSlug('distribution');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_DISTRIBUTION, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Education');
        $expertField->setSlug('education');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_EDUCATION, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Energie');
        $expertField->setSlug('energie');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_ENERGIE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Finance');
        $expertField->setSlug('finance');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_FINANCE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Industrie');
        $expertField->setSlug('industrie');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_INDUSTRIE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Informatique');
        $expertField->setSlug('informatique');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_INFORMATIQUE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Immobilier');
        $expertField->setSlug('immobilier');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_IMMOBILIER, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Logistique');
        $expertField->setSlug('logistique');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_LOGISTIQUE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Médias');
        $expertField->setSlug('medias');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_MEDIAS, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Medical');
        $expertField->setSlug('medical');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_MEDICAL, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Pharmaceutique');
        $expertField->setSlug('pharmaceutique');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_PHARMACEUTIQUE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Prestations de services');
        $expertField->setSlug('prestations-de-services');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_PRESTATIONS_DE_SERVICES, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Public');
        $expertField->setSlug('public');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_PUBLIC, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Restauration');
        $expertField->setSlug('restauration');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_RESTAURATION, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Santé');
        $expertField->setSlug('sante');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_SANTE, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Social');
        $expertField->setSlug('social');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_SOCIAL, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Sport');
        $expertField->setSlug('sport');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_SPORT, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Tourisme');
        $expertField->setSlug('tourisme');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_TOURISME, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Transport');
        $expertField->setSlug('transport');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_TRANSPORT, $expertField);
        $manager->flush();

        $expertField = new ExpertiseField();
        $expertField->setLabel('Autre');
        $expertField->setSlug('autre');
        $manager->persist($expertField);
        $this->addReference(self::EXPERTISE_FIELD_AUTRE, $expertField);
        $manager->flush();
    }
}
