<?php

namespace App\Repository;

// use DateTime;
// use App\Entity\FormSubmission;
// use App\Utils\Utils;

class FormSubmissionRepository
{
//     /**
//     * Get FormSubmission from database with given token
//     *
//     * @param string $token FormSubmission Token
//     *
//     * @return FormSubmission
//     */
//     public static function getFormSubmission($token)
//     {

//         if (FormSubmission::TOKEN_EXAMPLE === $token) {
//             $formSubmission = new FormSubmission(
//                 FormSubmission::TOKEN_EXAMPLE,
//                 999999
//             );

//             return $formSubmission;
//         }

//         global $wpdb;

//         $table = CUSTOM_TABLE_FORMS_TOKENS;

//         $formSubmissionRow = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE token = %s", $token ) );

//         $formSubmission = new FormSubmission(
//             Utils::getProp('token', $formSubmissionRow),
//             Utils::getProp('form_id', $formSubmissionRow),
//             Utils::getProp('created_at', $formSubmissionRow),
//         );

//         $formSubmission->setUsedAt(Utils::getProp('used_at', $formSubmissionRow));
//         $formSubmission->setCompanyEntityId(Utils::getProp('company_id', $formSubmissionRow));
//         $formSubmission->setContext(Utils::getProp('context', $formSubmissionRow));

//         return $formSubmission;
//     }

//     /**
//     * Get FormSubmission from database with given token
//     *
//     * @param string $token FormSubmission Token
//     *
//     * @return FormSubmission
//     */
//     public static function commitFormSubmission($formSubmission)
//     {
//         if (!$formSubmission instanceof FormSubmission || !$formSubmission->isValid()) {
//             return false;
//         }

//         global $wpdb;

//         $values = [
//             'token' => $formSubmission->getToken(),
//             'form_id' => $formSubmission->getFormId(),
//             'company_id' => $formSubmission->getCompanyEntityId(),
//         ];

//         return $wpdb->insert(CUSTOM_TABLE_FORMS_TOKENS, $values);
//     }

//     /**
//      * Set "used_at" field for given token
//      *
//      * @param string $token
//      * @param DateTime $date
//      *
//      * @return bool
//      */
//     public static function setUsed($token, $date = null)
//     {
//         if (FormSubmission::TOKEN_EXAMPLE === $token) {
//             return true;
//         }

//         if (!$date instanceof DateTime) {
//             $date = date('Y-m-d H:i:s');
//         }

//         if (FormSubmission::isValidToken($token)) {
//             global $wpdb;

//             $nbRowsUpdated = $wpdb->update(
//                 CUSTOM_TABLE_FORMS_TOKENS,
//                 [
//                     'used_at' => $date
//                 ],
//                 [
//                     'token' => $token
//                 ]
//             );

//             if ($nbRowsUpdated > 0) {
//                 return true;
//             }
//         }

//         return false;
//     }
}
