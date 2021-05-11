<?php
namespace App\Type;

use App\Entity\Badge;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Badge Doctrine Custom Type
 */
final class BadgeType extends Type
{
    const BADGE_TYPE_NAME = 'badge';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'Badge';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Badge($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof Badge && $value->hasSlug()) {
            return $value->getSlug();
        }

        return null;
    }

    public function getName()
    {
        return self::BADGE_TYPE_NAME;
    }
}
