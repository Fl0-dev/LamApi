<?php

namespace App\Tests\Unit;

use App\Entity\Tool;
use App\Repository\ToolRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ToolUnitTest extends KernelTestCase
{

    public function testGetAllTools(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);
        $tools = $toolRepository->findAll();

        $this->assertIsArray($tools);
        $this->assertNotEmpty($tools);
        $this->assertContainsOnlyInstancesOf(Tool::class, $tools);
    }

    public function testGetToolByValue(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);
        $tool = $toolRepository->findOneBy(['slug' => 'teams']);
        $this->assertInstanceOf(Tool::class, $tool);

        $toolId = $tool->getId();
        $tool = $toolRepository->find($toolId);
        $this->assertInstanceOf(Tool::class, $tool);
    }

    public function testNoGetToolByValue(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);
        $tool = $toolRepository->findOneBy(['slug' => 'nimportequoi']);
        $this->assertNotInstanceOf(Tool::class, $tool);

        $tool = $toolRepository->find('1ed5ea1a-2af6-6aea-b8cf-9513b2072358');
        $this->assertNotInstanceOf(Tool::class, $tool);
    }

    public function testAddToolWithGoodValues(): void
    {
        $tool = new Tool();
        $tool->setSlug('test-tool');
        $tool->setLabel('Test Tool');

        $toolRepository = static::getContainer()->get(ToolRepository::class);
        $toolRepository->add($tool, true);

        $this->assertTrue(uuid_is_valid($tool->getId()));
    }

    public function testUpdateToolWithGoodValues(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);
        $tool = $toolRepository->findOneBy(['slug' => 'test-tool']);
        $tool->setLabel('Test Tool Updated');

        $toolRepository->add($tool, true);

        $this->assertEquals('Test Tool Updated', $tool->getLabel());
    }

    public function testUpdateToolWithGoodSlug(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);
        $tool = $toolRepository->findOneBy(['slug' => 'test-tool']);
        $tool->setSlug('test-tool-updated');

        $toolRepository->add($tool, true);

        $this->assertEquals('test-tool-updated', $tool->getSlug());
    }
    public function testUpdateToolWithWrongSlug(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);

        $tool = $toolRepository->findOneBy(['slug' => 'test-tool-updated']);
        $tool->setSlug('test-tool updated');
        $toolRepository->add($tool, true);
        $this->assertEquals('test-tool-updated', $tool->getSlug());
    }

    public function testAddToolWithEmptyValue(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);
        $tool = new Tool();

        try {
            $toolRepository->add($tool, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testAddToolWithEmptyLabel(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);
        $tool = new Tool();
        $tool->setSlug('test-tool');

        try {
            $toolRepository->add($tool, true);
            $this->assertTrue(false, 'An exception should have been thrown');
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testRemoveTool(): void
    {
        $toolRepository = static::getContainer()->get(ToolRepository::class);
        $tool = $toolRepository->findOneBy(['slug' => 'test-tool-updated']);
        $toolRepository->remove($tool, true);

        $tool = $toolRepository->findOneBy(['slug' => 'test-tool-updated']);
        $this->assertNull($tool);
    }
}
