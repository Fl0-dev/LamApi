<?php

namespace App\Repository;

// use App\Entity\Parrain;
// use Doctrine\Common\Collections\ArrayCollection;

class ParrainRepository
{
//     /**
//     * Get information on Parrain
//     *
//     * @param string $code Code Parrain
//     *
//     * @return ArrayCollection|null
//     */
//     public static function getParrain($code)
//     {
//         $metaQuery[] = [
//             'key' => 'code_parrain',
//             'value' => $code
//         ];

//         $args = array(
//             'numberposts' => 1,
//             'post_status' => 'publish',
//             'category__in' => [
//                 COMPANY_TAG_ID,
//                 ECOSYSTEM_TAG_ID,
//                 LAMA_ECOSYSTEM_TAG_ID,
//                 TOOL_TAG_ID
//             ],
//             'meta_query' => $metaQuery
//         );

//         $query = new \WP_Query($args);

//         $parrain = null;

//         if (!empty($query->posts)) {
//             $parrain = new Parrain();
//             $parrain->setObjectFromPost(array_shift($query->posts));
//         }

//         return $parrain;
//     }

//     /**
//     * Get Information of Parrain under PHP Array (for API)
//     *
//     * @param string $code Parrain Code
//     *
//     * @return array|null
//     */
//     public static function getParrainInfos($code)
//     {
//         $parrain = self::getParrain($code);

//         $response = null;

//         if ($parrain instanceof Parrain) {
//             $response['code'] = $code;
//             $response['name'] = $parrain->getName();

//             $response['logo'] = null;

//             if ($parrain->hasLogo()) {
//                 $response['logo'] = $parrain->getLogo()->getSrc();
//             }

//             $response['website'] = $parrain->getWebsite();
//         }

//         return $response;
//     }
}
