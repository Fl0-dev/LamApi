<?php

namespace App\Tests\Api\EmployerLamatch;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class EmployerLamatchSecurityTest extends ApiTestCase
{
    public function testEndpointWithNoConnexion(): void
    {
        $response = static::createClient()->request('GET', '/employer/lamatch/results');

        $this->assertResponseStatusCodeSame(401);
    }

    public function testEndPointWithApplicantConnexion(): void
    {
       
    }

    public function testEndPointWithEmployerByWrongProfile(): void
    {
       
    }

    public function testEndPointWithEmployerByWrongProfileId(): void
    {
       
    }

    public function testEndPointWithEmployerByGoodProfileId(): void
    {
       
    }
}
