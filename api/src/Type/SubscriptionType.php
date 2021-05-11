<?php
namespace App\Type;

use App\Entity\Subscription;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Subscription Doctrine Custom Type
 */
final class SubscriptionType extends Type
{
    const SUBSCRIPTION_TYPE_NAME = 'subscription';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'Subscription';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Subscription($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof Subscription && $value->hasSlug()) {
            return $value->getSlug();
        }

        return null;
    }

    public function getName()
    {
        return self::SUBSCRIPTION_TYPE_NAME;
    }
}
