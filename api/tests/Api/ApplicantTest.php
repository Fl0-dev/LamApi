<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Repository\ApplicantRepositories\ApplicantRepository;

class ApplicantTest extends ApiTestCase
{
    public function testGetCollectionOfApplicants(): void
    {
        $response = static::createClient()->request('GET', '/applicants');

        $this->assertJsonContains([
            '@context' => '/contexts/Applicant',
            '@id' => '/applicants',
            '@type' => 'hydra:Collection',
        ]);
    }

    public function testPostApplicantWithBadEmail(): void
    {
        $response = static::createClient()->request('POST', '/applicants', ['json' => [
            'email' => '',
            'password' => 'password',
        ]]);

        $this->assertResponseStatusCodeSame(500);

        $response = static::createClient()->request('POST', '/applicants', ['json' => [
            'email' => 'trt',
            'password' => 'password',
        ]]);

        $this->assertResponseStatusCodeSame(500);
    }

    public function testPostApplicantWithBadPassword(): void
    {
        $response = static::createClient()->request('POST', '/applicants', ['json' => [
            'email' => 'test@gmail.com',
            'password' => 'pass',
        ]]);

        $this->assertResponseStatusCodeSame(500);

        $response = static::createClient()->request('POST', '/applicants', ['json' => [
            'email' => 'test@gmail.com',
            'password' => '',
        ]]);

        $this->assertResponseStatusCodeSame(500);

        $response = static::createClient()->request('POST', '/applicants', ['json' => [
            'email' => 'test@gmail.com',
            'password' => 123456789,
        ]]);

        $this->assertResponseStatusCodeSame(400);
    }

    public function testPostApplicantWithGoodData(): void
    {
        $response = static::createClient()->request('POST', '/applicants', ['json' => [
            'email' => 'test@gmail.com',
            'password' => 'password',
        ]]);

        $this->assertResponseIsSuccessful();
    }

    public function testAddApplicantWithAllReadyExistEmail(): void
    {
        $response = static::createClient()->request('POST', '/applicants', ['json' => [
            'email' => 'test@gmail.com',
            'password' => 'password',
        ]]);

        $this->assertResponseStatusCodeSame(500);
    }

    public function testDeleteApplicant(): void
    {
        $applicantRepository = static::getContainer()->get(ApplicantRepository::class);
        $applicant = $applicantRepository->findOneBy(['email' => 'test@gmail.com']);
        $id = $applicant->getId();
        $response = static::createClient()->request('DELETE', "/applicants/$id");

        $this->assertResponseStatusCodeSame(204);
    }
}
