<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\JobTitle;
use App\Repository\JobTitleRepository;

class JobTitleTest extends ApiTestCase
{
    public function testGetCollectionOfJobTitles(): void
    {
        $response = static::createClient()->request('GET', '/job_titles');

        $this->assertJsonContains([
            '@context' => '/contexts/JobTitle',
            '@id' => '/job_titles',
            '@type' => 'hydra:Collection',
            "hydra:totalItems" => 34,
            "hydra:search" => [
              "@type" => "hydra:IriTemplate",
              "hydra:template" => "/job_titles{?slug}",
              "hydra:variableRepresentation" => "BasicRepresentation",
              "hydra:mapping" => [
                [
                  "@type" => "IriTemplateMapping",
                  "variable" => "slug",
                  "property" => "slug",
                  "required" => false
                ]
              ]
            ]
        ]);
    }

    public function testGetJobTitle(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitle = $jobTitleRepository->findBySlug('assistant-administratif');
        $id = $jobTitle->getId();
        
        $response = static::createClient()->request('GET', "/job_titles/$id");

        $this->assertJsonContains([
          "@context" => "/contexts/JobTitle",
          "@id" => "/job_titles/$id",
          "@type" => "JobTitle",
          "jobTypes" => [],
          "id" => "$id",
          "slug" => "assistant-administratif",
          "label" => "Assistant administratif"
        ]);
    }

    public function testGetErrorIfNotJobTitleId(): void
    {
        $response = static::createClient()->request('GET', "/job_titles/1s1g-fdf5-sdfsfs-2131");

        $this->assertResponseStatusCodeSame(404);
    }

    public function testPostJobTitle(): void
    {
        $response = static::createClient()->request('POST', '/job_titles', ['json' => [
            'slug' => 'test-job-title',
            'label' => 'Test Job Title'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@context' => '/contexts/JobTitle',
            '@type' => 'JobTitle',
            'slug' => 'test-job-title',
            'label' => 'Test Job Title'
        ]);
        $this->assertMatchesResourceItemJsonSchema(JobTitle::class);
    }

    public function testDeleteJobTitle(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitle = $jobTitleRepository->findBySlug('test-job-title');

        $response = static::createClient()->request('DELETE', '/job_titles/' . $jobTitle->getId());

        $this->assertResponseStatusCodeSame(204);
    }

    public function testIsJobTitle(): void
    {
        $jobTitleRepository = static::getContainer()->get(JobTitleRepository::class);
        $jobTitle = $jobTitleRepository->findBySlug('assistant-administratif');
        $id = $jobTitle->getId();

        $response = static::createClient()->request('GET', "/job_titles/$id");

        $this->assertMatchesResourceItemJsonSchema(JobTitle::class);
    }
}
