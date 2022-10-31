<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class ApplicantTest extends ApiTestCase
{
    public function testGetCollectionOfApplicants(): void
    {
        $response = static::createClient()->request('GET', '/applicants');

        $this->assertJsonContains([
            '@context' => '/contexts/Applicant',
            '@id' => '/applicants',
            '@type' => 'hydra:Collection',
            "hydra:totalItems" => 9,
        ]);
    }
}
