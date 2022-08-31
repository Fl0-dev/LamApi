<?php

namespace App\Validator;

use App\Entity\References\ContractType;
use App\Entity\References\Experience;
use App\Entity\References\LevelOfStudy;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsInRepositoryValidator extends ConstraintValidator
{
    const PROPERTY_CONTRACT_TYPE = 'contractType';
    const PROPERTY_EXPERIENCE = 'experience';
    const PROPERTY_LEVEL_OF_STUDY = 'levelOfStudy';

    public function validate($value, Constraint $constraint)
    {
        /* @var App\Validator\IsInRepository $constraint */
        $property = $this->context->getPropertyPath();

        switch ($property) {
            case self::PROPERTY_CONTRACT_TYPE:
                if (ContractType::isContractType($value)) {
                    return;
                }
                break;

            case self::PROPERTY_EXPERIENCE:
                if (Experience::isExperience($value)) {
                    return;
                }
                break;

            case self::PROPERTY_LEVEL_OF_STUDY:
                if (LevelOfStudy::isLevelOfStudy($value)) {
                    return;
                }
                break;
        }
        if (null === $value || '' === $value) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->setParameter('{{ property }}', $property)
            ->addViolation();
    }
}
