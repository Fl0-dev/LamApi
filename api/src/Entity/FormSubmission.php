<?php

// namespace App\Entity;

// use DateTime;
// use App\Repository\FormSubmissionRepository;
// use App\Transversal\CreatedDate;
// use App\Transversal\Uuid;
// use App\Utils\Utils;

// class FormSubmission extends FormSubmissionRepository
// {
//     use Uuid;
//     use CreatedDate;

//     const TOKEN_MIN_LENGTH = 73;
//     const TOKEN_MAX_LENGTH = 134;
//     const TOKEN_EXAMPLE = 'azm1MSXRDt44zjh5LJutygrv3wZFVSn85YtmXhz2BgMRAdgy9g0Am';

//     /**
//      * FormSubmission Token
//      *
//      * @var string
//      */
//     private $token;

//     /**
//      * FormSubmission Used At
//      *
//      * @var DateTime
//      */
//     private $usedAt;

//     /**
//      * FormSubmission Context, to add informations
//      *
//      * @var string
//      */
//     private $context;

//     /**
//      * FormSubmission Form ID
//      *
//      * @var int
//      */
//     private $formId;

//     /**
//      * FormSubmission CompanyEntity ID, if it's concerned (nullable)
//      *
//      * @var int
//      */
//     private $companyId;


//     /**
//      * FormSubmission Contructor
//      */
//     public function __construct($token, $formId, $createdDate = null)
//     {
//         $this->setToken($token);
//         $this->setFormId($formId);
//         $this->setCreatedDate($createdDate);
//     }

//     /**
//      * Check if self is a valid FormSubmission object with required data
//      *
//      * @return boolean
//      */
//     public function isValid()
//     {
//         return $this->hasToken() && $this->hasFormId();
//     }

//     /**
//      * Check if token FormSubmission is already used
//      *
//      * @return bool
//      */
//     public function hasTokenUsed()
//     {
//         $usedAt = $this->getUsedAt();

//         return ($usedAt instanceof DateTime && $usedAt > new DateTime('2020-12-01'));
//     }

//     /**
//      * Generate random Token
//      *
//      * @return string
//      */
//     static public function generateToken()
//     {
//         return bin2hex(random_bytes(random_int(self::TOKEN_MIN_LENGTH, self::TOKEN_MAX_LENGTH) / 2));
//     }

//     /**
//      * Check if given token is a valid FormSubmission Token
//      *
//      * @return bool
//      */
//     public static function isValidToken($token)
//     {
//         return is_string($token)
//             && strlen($token) >= self::TOKEN_MIN_LENGTH
//             && strlen($token) <= self::TOKEN_MAX_LENGTH;
//     }

//     /**
//      * Get FormSubmission Token
//      *
//      * @return string
//      */
//     public function getToken()
//     {
//         return $this->token;
//     }

//     /**
//      * Set FormSubmission Token
//      *
//      * @param string $token FormSubmission token
//      *
//      * @return self
//      */
//     public function setToken($token)
//     {
//         $this->token = $token;

//         return $this;
//     }

//     /**
//      * Check if FormSubmission has a valid Form ID value
//      *
//      * @return bool
//      */
//     public function hasToken()
//     {
//         $token = $this->getToken();

//         return is_string($token) && strlen($token) > 10;
//     }

//     /**
//      * Get FormSubmission Used At
//      *
//      * @return DateTime
//      */
//     public function getUsedAt()
//     {
//         return $this->usedAt;
//     }

//     /**
//      * Set FormSubmission Used At
//      *
//      * @param string $usedAt FormSubmission usedAt
//      *
//      * @return self
//      */
//     public function setUsedAt($usedAt)
//     {
//         if (is_string($usedAt)) {
//             $usedAt = Utils::createDateTimeFromString($usedAt);
//         }

//         if ($usedAt instanceof DateTime) {
//             $this->usedAt = $usedAt;
//         }

//         return $this;
//     }

//     /**
//      * Get FormSubmission Context
//      *
//      * @return string
//      */
//     public function getContext()
//     {
//         return $this->context;
//     }

//     /**
//      * Set FormSubmission Context
//      *
//      * @param string $context FormSubmission context
//      *
//      * @return self
//      */
//     public function setContext($context)
//     {
//         $this->context = $context;

//         return $this;
//     }

//     /**
//      * Check if FormSubmission has a valid Context value
//      *
//      * @return bool
//      */
//     public function hasContext()
//     {
//         $context = $this->getContext();

//         return is_string($context) && strlen($context) > 0;
//     }

//     /**
//      * Get the value of Form ID
//      *
//      * @return int
//      */
//     public function getFormId()
//     {
//         return $this->formId;
//     }

//     /**
//      * Set the value of Form ID
//      *
//      * @param int $formId Form ID
//      *
//      * @return self
//      */
//     public function setFormId($formId)
//     {
//         $this->formId = (int) $formId;

//         return $this;
//     }

//     /**
//      * Check if FormSubmission has a valid Form ID value
//      *
//      * @return bool
//      */
//     public function hasFormId()
//     {
//         $formId = $this->getFormId();

//         return is_int($formId) && $formId > 0;
//     }

//     /**
//      * Get the value of CompanyEntity ID
//      *
//      * @return int
//      */
//     public function getCompanyEntityId()
//     {
//         return $this->companyId;
//     }

//     /**
//      * Set the value of CompanyEntity ID
//      *
//      * @param int $companyId CompanyEntity ID
//      *
//      * @return self
//      */
//     public function setCompanyEntityId($companyId)
//     {
//         $this->companyId = (int) $companyId;

//         return $this;
//     }

//     /**
//      * Check if FormSubmission has a valid CompanyEntity ID value
//      *
//      * @return bool
//      */
//     public function hasCompanyEntityId()
//     {
//         $companyId = $this->getCompanyEntityId();

//         return is_int($companyId) && $companyId > 0;
//     }
// }
