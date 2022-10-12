<?php

namespace App\Validator;

use App\Entity\References\ContractType;
use App\Entity\References\Experience;
use App\Entity\References\LevelOfStudy;
use App\Repository\ReferencesRepositories\ContractTypeRepository;
use App\Repository\ReferencesRepositories\ExperienceRepository;
use App\Repository\ReferencesRepositories\LevelOfStudyRepository;
use App\Repository\ReferencesRepositories\WorkforceRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsInRepositoryValidator extends ConstraintValidator
{
    public const PROPERTY_CONTRACT_TYPE = 'contractType';
    public const PROPERTY_EXPERIENCE = 'experience';
    public const PROPERTY_LEVEL_OF_STUDY = 'levelOfStudy';
    public const PROPERTY_WORKFORCE = 'workforce';

    public function __construct(
        private ContractTypeRepository $contractTypeRepository,
        private ExperienceRepository $experienceRepository,
        private LevelOfStudyRepository $levelOfStudyRepository,
        private WorkforceRepository $workforceRepository
    )
    {
    }

    public function validate($id, Constraint $constraint)
    {
        /* @var App\Validator\IsInRepository $constraint */
        $property = $this->context->getPropertyPath();

        switch ($property) {
            case self::PROPERTY_CONTRACT_TYPE:
                if ($this->contractTypeRepository->find($id) != null) {
                    return;
                }
                break;

            case self::PROPERTY_EXPERIENCE:
                if ($this->experienceRepository->find($id) != null) {
                    return;
                }
                break;

            case self::PROPERTY_LEVEL_OF_STUDY:
                if ($this->levelOfStudyRepository->find($id) != null) {
                    return;
                }
                break;

            case self::PROPERTY_WORKFORCE:
                if ($this->workforceRepository->find($id) != null) {
                    return;
                }
                break;
        }
        if (null === $id || '' === $id) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $id)
            ->setParameter('{{ property }}', $property)
            ->addViolation();
    }
}
