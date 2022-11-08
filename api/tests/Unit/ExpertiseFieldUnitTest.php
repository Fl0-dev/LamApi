<?php

namespace App\Tests\Unit;

use App\Entity\ExpertiseField;
use App\Repository\ExpertiseFieldRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ExpertiseFieldUnitTest extends KernelTestCase
{

    public function testGetAllExpertiseFields(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
        $expertiseFields = $expertiseFieldRepository->findAll();

        $this->assertIsArray($expertiseFields);
        $this->assertNotEmpty($expertiseFields);
        $this->assertContainsOnlyInstancesOf(ExpertiseField::class, $expertiseFields);
    }

    public function testGetExpertiseFieldByValue(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
        $expertiseField = $expertiseFieldRepository->findOneBy(['slug' => 'agricole']);
        $this->assertInstanceOf(ExpertiseField::class, $expertiseField);

        $expertiseFieldId = $expertiseField->getId();
        $expertiseField = $expertiseFieldRepository->find($expertiseFieldId);
        $this->assertInstanceOf(ExpertiseField::class, $expertiseField);
    }

    public function testNoGetExpertiseFieldByValue(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
        $expertiseField = $expertiseFieldRepository->findOneBy(['slug' => 'nimportequoi']);
        $this->assertNotInstanceOf(ExpertiseField::class, $expertiseField);

        $expertiseField = $expertiseFieldRepository->find('1ed5ea1a-2af6-6aea-b8cf-9513b2072358');
        $this->assertNotInstanceOf(ExpertiseField::class, $expertiseField);
    }

    public function testAddExpertiseFieldWithGoodValues(): void
    {
        $expertiseField = new ExpertiseField();
        $expertiseField->setSlug('test-expertise-field');
        $expertiseField->setLabel('Test Expertise Field');

        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
        $expertiseFieldRepository->add($expertiseField, true);

        $this->assertTrue(uuid_is_valid($expertiseField->getId()));
    }

    public function testUpdateExpertiseFieldWithGoodValues(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
        $expertiseField = $expertiseFieldRepository->findOneBy(['slug' => 'test-expertise-field']);
        $expertiseField->setLabel('Test Expertise Field Updated');

        $expertiseFieldRepository->add($expertiseField, true);

        $this->assertEquals('Test Expertise Field Updated', $expertiseField->getLabel());
    }

    public function testUpdateExpertiseFieldWithGoodSlug(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
        $expertiseField = $expertiseFieldRepository->findOneBy(['slug' => 'test-expertise-field']);
        $expertiseField->setSlug('test-expertise-field-updated');

        $expertiseFieldRepository->add($expertiseField, true);

        $this->assertEquals('test-expertise-field-updated', $expertiseField->getSlug());
    }
    public function testUpdateExpertiseFieldWithWrongSlug(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);

        $expertiseField = $expertiseFieldRepository->findOneBy(['slug' => 'test-expertise-field-updated']);
        $expertiseField->setSlug('test-expertise-field updated');
        $expertiseFieldRepository->add($expertiseField, true);
        $this->assertEquals('test-expertise-field-updated', $expertiseField->getSlug());
    }

    public function testAddExpertiseFieldWithEmptyValue(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
        $expertiseField = new ExpertiseField();

        try {
            $expertiseFieldRepository->add($expertiseField, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testAddExpertiseFieldWithEmptyLabel(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
        $expertiseField = new ExpertiseField();
        $expertiseField->setSlug('test-expertise-field');

        try {
            $expertiseFieldRepository->add($expertiseField, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testRemoveExpertiseField(): void
    {
        $expertiseFieldRepository = static::getContainer()->get(ExpertiseFieldRepository::class);
        $expertiseField = $expertiseFieldRepository->findOneBy(['slug' => 'test-expertise-field-updated']);
        $expertiseFieldRepository->remove($expertiseField, true);

        $expertiseField = $expertiseFieldRepository->findOneBy(['slug' => 'test-expertise-field-updated']);
        $this->assertNull($expertiseField);
    }
}
