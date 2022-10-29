<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Badge;
use App\Repository\BadgeRepository;

class BadgeTest extends ApiTestCase
{
    public function testGetCollectionOfBadges(): void
    {
        $response = static::createClient()->request('GET', '/badges');

        $this->assertJsonContains([
            '@context' => '/contexts/Badge',
            '@id' => '/badges',
            '@type' => 'hydra:Collection',
            "hydra:totalItems" => 10,
            "hydra:search" => [
                "@type" => "hydra:IriTemplate",
                "hydra:template" => "/badges{?slug}",
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

    public function testGetBadge(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);

        /** @var Badge $badge */
        $badge = $badgeRepository->findOneBy(['slug' => 'impact-plus']);

        $id = $badge->getId();

        $response = static::createClient()->request('GET', "/badges/$id");

        $this->assertJsonContains([
            "@context" => "/contexts/Badge",
            "@id" => "/badges/$id",
            "@type" => "Badge",
            "imageUri" => "impact-plus.svg",
            "badgePath" => "/assets/images/badges/impact-plus.svg",
            "label" => "Cabinet à impact +",
            "slug" => "impact-plus"
        ]);
    }

    public function testGetErrorIfNotBadgeId(): void
    {
        $response = static::createClient()->request('GET', "/badges/1s1g-fdf5-sdfsfs-2131");

        $this->assertResponseStatusCodeSame(404);
    }

    public function testPostBadge(): void
    {
        $response = static::createClient()->request('POST', '/badges', ['json' => [
            "imageUri" => "string.svg",
            "description" => "description d'un badge",
            "badgePath" => "/assets/images/badges/string.svg",
            "label" => "Badge Test",
            "slug" => "badge-test"
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@context' => '/contexts/Badge',
            '@type' => 'Badge',
            "imageUri" => "string.svg",
            "description" => "description d'un badge",
            "badgePath" => "/assets/images/badges/string.svg",
            "label" => "Badge Test",
            "slug" => "badge-test"
        ]);
        $this->assertMatchesResourceItemJsonSchema(Badge::class);
    }

    public function testDeleteBadge(): void
    {
        $badgeRepository = static::getContainer()->get(BadgeRepository::class);
        $badge = $badgeRepository->findOneBy(['slug' => 'badge-test']);
        $id = $badge->getId();

        $response = static::createClient()->request('DELETE', "/badges/$id");

        $this->assertResponseStatusCodeSame(204);
    }
}
