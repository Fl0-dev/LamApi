<?php

namespace App\Validator;

use App\Entity\Repositories\ContractType;
use App\Entity\Repositories\Experience;
use App\Entity\Repositories\LevelOfStudy;
use App\Entity\Repositories\OfferStatus;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsInRepositoryValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var App\Validator\IsInRepository $constraint */
        $property = $this->context->getPropertyPath();

        switch ($property) {
            case 'contractType':
                if (ContractType::isContractType($value)) {
                    return;            
                }
                break;

            case 'experience':
                if (Experience::isExperience($value)) {
                    return;            
                }
                break;

            case 'levelOfStudy':
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
