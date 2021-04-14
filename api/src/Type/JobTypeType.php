<?php
namespace App\Type;

use App\Entity\JobType;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * JobType Doctrine Custom Type
 */
class JobTypeType extends Type
{
    const JOB_TYPE_TYPE_NAME = 'job_type';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'JobType';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new JobType($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof JobType && $value->hasSlug()) {
            return $value->getSlug();
        }

        return null;
    }

    public function getName()
    {
        return self::JOB_TYPE_TYPE_NAME;
    }
}
