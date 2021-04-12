<?php

namespace App\Repository;

// use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

// use App\Entity\Company\Entity\CompanyEntity;
// use App\Entity\Offer\Offer;
// use Doctrine\Common\Collections\ArrayCollection;
// use App\Utils\Utils;

class OfferRepository
{
//     /**
//      * Get all offers or offers with id in given $ids
//      *
//      * @param array|null $ids Offer ids asked
//      *
//      * @return ArrayCollection Posts array
//      */
//     public static function getOffers($ids = null, $limit = -1, $onlyPremium = false, $light = false)
//     {
//         $metaQuery[]      = [
//             'key'       => 'provided',
//             'value'     => '0'
//         ];

//         $args = [
//             'posts_per_page' => -1,
//             'post_status'    => 'publish',
//             'category_name'  => OFFER_TAG_SLUG,
//             'post__in'       => $ids,
//             'post__not_in'   => OFFERS_ID_TO_EXCLUDE,
//             'meta_query'     => $metaQuery
//         ];

//         $query = new \WP_Query($args);

//         $offers = Offer::getObjectsFromPosts($query->posts, $light);

//         return self::getOffersSorted($offers, $limit, $onlyPremium);
//     }

//     /**
//      * Get all offers with light information
//      *
//      * @param array|null $ids Offer ids asked
//      *
//      * @return array Posts array
//      */
//     public static function getOffersLight($ids = null, $limit = -1, $onlyPremium = false)
//     {
//         return self::getOffers($ids, $limit, $onlyPremium, true);
//     }

//     /**
//      * Get offers depends on fitlers
//      *
//      * @param array $filters Filters on fields (view Repository::buildWhere)
//      *
//      * @return ArrayCollection
//      */
//     public static function getOffersByFilters($filters, $idsToExclude = [])
//     {
//         $fJobTitles     = Repository::getFilterValue($filters, 'job_titles');
//         $fContractTypes = Repository::getFilterValue($filters, 'contract_types');
//         $fCitiesAndDept = Repository::getFilterValue($filters, 'cities_and_dept');
//         $fExperiences   = Repository::getFilterValue($filters, 'experiences');

//         $metaQuery[]      = [
//             'key'       => 'provided',
//             'value'     => '0'
//         ];

//         if (self::isValidFilterJobTitles($fJobTitles)) {
//             $metaQuery[] = [
//                 'key'       => 'details_job_title',
//                 'value'     => $fJobTitles,
//                 'compare'   => 'IN'
//             ];
//         }

//         if (self::isValidFilterContractTypes($fContractTypes)) {
//             $metaQuery[] = [
//                 'key'       => 'details_contract_type',
//                 'value'     => $fContractTypes,
//                 'compare'   => 'IN'
//             ];
//         }

//         if (self::isValidFilterCitiesOrDept($fCitiesAndDept)) {
//             $fCities = [];
//             $depts = [];

//             foreach ($fCitiesAndDept as $item) {
//                 if (strpos($item, 'city-') > -1) {
//                     $fCities[] = (int) str_replace('city-', '', $item);
//                     continue;
//                 }

//                 if (strpos($item, 'dept-') > -1) {
//                     $depts[] = (int) str_replace('dept-', '', $item);
//                 }
//             }

//             if (!empty($depts)) {
//                 $cities = LocalisationRepository::getCitiesByDepartments($depts)->toArray();

//                 $cities = array_map(function ($city) {
//                     return (int) Utils::getProp('id', $city);
//                 }, $cities);

//                 $fCities = array_merge($fCities, $cities);
//             }

//             $metaQuery[] = [
//                 'key'       => 'details_address_city',
//                 'value'     => $fCities,
//                 'compare'   => 'IN'
//             ];
//         }

//         if (self::isValidFilterExperiences($fExperiences)) {
//             $metaQuery[] = [
//                 'key'       => 'details_experience',
//                 'value'     => $fExperiences,
//                 'compare'   => 'IN'
//             ];
//         }

//         $idsToExclude = array_merge($idsToExclude, OFFERS_ID_TO_EXCLUDE);

//         $args = [
//             'posts_per_page' => -1,
//             'post_status'    => 'publish',
//             'post_type'      => 'post',
//             'category_name'  => OFFER_TAG_SLUG,
//             'post__not_in'   => $idsToExclude,
//             'meta_query'     => $metaQuery
//         ];

//         $query = new \WP_Query($args);

//         $offers = Offer::getObjectsFromPosts($query->posts);

//         return self::getOffersSorted($offers);
//     }

//     /**
//      * Sort given offers with functional rules
//      *
//      * @param ArrayCollection $offers Offers to sort
//      *
//      * @return ArrayCollection
//      */
//     public static function getOffersSorted($offers, $limit = -1, $onlyPremium = false)
//     {
//         if ($offers instanceof ArrayCollection) {
//             $offers = $offers->toArray();
//         }

//         if (is_array($offers)) {
//             shuffle($offers);
//             $companiesAlreadyPast = [];

//             // Define weight for each offer
//             foreach ($offers as $key => $offer) {
//                 $weight = 1;

//                 if ($offer->hasSalary()) {
//                     $weight += 200;
//                 }

//                 $company = $offer->getCompanyEntity();
//                 $companyId = $company->getId();

//                 if ($onlyPremium && !$company->isPremium()) {
//                     unset($offers[$key]);
//                     continue;
//                 }

//                 $companiesAlreadyPast[] = $companyId;

//                 if ($company->hasHeaderMedia()) {
//                     $weight += 15;
//                 }

//                 // Premium always displayed first
//                 if ($company instanceof CompanyEntity && $company->isPremium()) {
//                     $weight += 10000;
//                 }

//                 $nbAppearances = count(array_keys($companiesAlreadyPast, $companyId));
//                 $weight -= mt_rand(4, 5) * $nbAppearances;

//                 // Sort by publish date
//                 // $publishTimestamp = $offer->getPublishDate()->getTimeStamp();
//                 // $weight = $weight + 0.000001 * $publishTimestamp;

//                 $offers[$key]->weight = $weight;
//             }

//             // Sort $offers depending $weights
//             usort($offers, function ($offerA, $offerB) {
//                 return $offerB->weight <=> $offerA->weight;
//             });
//         }

//         if ($limit > -1 && is_array($offers)) {
//             // $offers = array_slice($offers, 0, $limit * 3);
//             // shuffle($offers);
//             $offers = array_slice($offers, 0, $limit);
//         }

//         return Utils::createArrayCollection($offers);
//     }

//     /**
//      * Dump Offers for technical maintenance
//      *
//      * @param ArrayCollection $offers Offers to dump
//      *
//      * @return void
//      */
//     public static function dumpOffers($offers)
//     {
//         if ($offers instanceof ArrayCollection) {
//             $offers = $offers->toArray();
//         }

//         foreach ($offers as $offer) {
//             $company = $offer->getCompanyEntity();

//             echo $offer->getTitle() . ' - '
//             . $company->getName() . ' : '
//             . ($company->isPremium() ? 'PREMIUM !' : 'Free')
//             . ' - Salaire min : ' . $offer->getSalaryMin()
//             . ' | Date : ' . $offer->getPublishDate()->format('Y-m-d H:i:s')
//             . '<br>';
//         }

//         echo '<br><br>';
//     }

//     /**
//      * Get Offers Ids from the given list of offers
//      *
//      * @param ArrayCollection|array $offers Offers to use
//      *
//      * @return array
//      */
//     public static function getOffersIds($offers)
//     {
//         $ids = [];

//         if ($offers instanceof ArrayCollection) {
//             $offers = $offers->toArray();
//         }

//         if (is_array($offers)) {
//             foreach ($offers as $offer) {
//                 if ($offer instanceof Offer) {
//                     $ids[] = $offer->getId();
//                 }
//             }
//         }

//         return $ids;
//     }

//     /**
//      * Get all job titles for Offers
//      *
//      * @return ArrayCollection Posts array
//      */
//     public static function getOffersJobs($jobTitle = null)
//     {
//         $args = [
//             'posts_per_page' => -1,
//             'post_status'    => 'publish',
//             'category_name'  => 'jobs',
//             'orderby'        => ['post_title' => 'ASC']
//         ];

//         if (is_string($jobTitle) && strlen($jobTitle) > 0) {
//             $args['search_post_title'] = $jobTitle;
//             add_filter('posts_where', ['App\Repository\Repository', 'setWPPostTitleFilter'], 10, 2);
//         }

//         $query = new \WP_Query($args);
//         remove_filter('posts_where', ['App\Repository\Repository', 'setWPPostTitleFilter'], 10);

//         return Utils::createArrayCollection($query->posts);
//     }

//     /**
//      * Get number of total Offers
//      *
//      * @return int Number of Offers
//      */
//     public static function getNbOffers()
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();

//         $idOffersToExlude = implode(',', OFFERS_ID_TO_EXCLUDE);
//         $idOfferTag       = OFFER_TAG_ID;

//         $sql = "SELECT count(p.ID) AS nb_offers
//                 FROM $db->posts AS p
//                 INNER JOIN $db->term_relationships AS tr
//                     ON p.ID = tr.object_id AND tr.term_taxonomy_id = $idOfferTag
//                 INNER JOIN $db->postmeta AS pm
//                     ON p.ID = pm.post_id
//                 WHERE p.ID NOT IN ($idOffersToExlude)
//                     AND ( pm.meta_key = 'provided' AND pm.meta_value = '0' )
//                     AND p.post_type = 'post'
//                     AND p.post_status = 'publish'
//         ";

//         return (int) $db->get_row($sql)->nb_offers;
//     }

//     /**
//      * Get number Offers (publish and not provided) for the given CompanyEntity
//      *
//      * @param int|WP_Post $companyId ID or WP_Post CompanyEntity
//      *
//      * @return int Number of founded offers
//      */
//     public static function getNumberOffersForCompanyEntity($companyId)
//     {
//         if (Utils::isWPPost($companyId)) {
//             $companyId = $companyId->ID;
//         }

//         if (!is_int($companyId) || $companyId < 1) {
//             return null;
//         }

//         $repo = new Repository();
//         $db = $repo->getDb();

//         $sql = "SELECT count($db->posts.ID) as nb_offers
//                 FROM $db->posts
//                 LEFT JOIN $db->term_relationships
//                     ON $db->posts.ID = $db->term_relationships.object_id
//                 INNER JOIN $db->postmeta
//                     ON $db->posts.ID = $db->postmeta.post_id
//                 INNER JOIN $db->postmeta meta2
//                     ON $db->posts.ID = meta2.post_id
//                 WHERE $db->term_relationships.term_taxonomy_id = " . OFFER_TAG_ID . "
//                 AND ( $db->postmeta.meta_key = 'company' AND $db->postmeta.meta_value = $companyId )
//                 AND ( meta2.meta_key = 'provided' AND meta2.meta_value = 0 )
//                 AND $db->posts.post_type = 'post'
//                 AND $db->posts.post_status = 'publish'
//         ";

//         return (int)$db->get_row($sql)->nb_offers;
//     }

//     /**
//      * Get offers for a given company
//      *
//      * @param int|WP_Post $companyId CompanyEntity ID or WP_Post object
//      *
//      * @return ArrayCollection
//      */
//     public static function getOffersForCompanyEntity($companyId)
//     {
//         if (Utils::isWPPost($companyId)) {
//             $companyId = $companyId->ID;
//         }

//         $metaQuery[]      = [
//             'key'       => 'provided',
//             'value'     => '0'
//         ];

//         $args = [
//             'posts_per_page' => -1,
//             'post_status'    => 'publish',
//             'category'       => OFFER_TAG_ID,
//             'orderby'        => 'date',
//             'order'          => 'DESC',
//             'meta_key'       => 'company',
//             'meta_value'     => $companyId,
//             'post_type'      => 'post',
//             'meta_query'     => $metaQuery
//         ];

//         $query = new \WP_Query($args);

//         return Offer::getObjectsFromPosts($query->posts);
//     }

//     /**
//      * Get Offers Infos in JSON format for given Offers
//      *
//      * @param ArrayCollection $offers
//      *
//      * @return json
//      */
//     public static function getOffersInfosJson($offers)
//     {
//         $jsonResult = [];

//         if ($offers instanceof ArrayCollection) {
//             $offers = $offers->toArray();
//         }

//         if (is_array($offers)) {
//             foreach ($offers as $offer) {
//                 if ($offer instanceof Offer) {
//                     $jsonResult[] = $offer->toArray();
//                 }
//             }
//         }

//         return json_encode($jsonResult);
//     }

//     /**
//      * Get Offers Addresses Infos in JSON format for given Offers
//      *
//      * @param ArrayCollection $offers
//      *
//      * @return json
//      */
//     public static function getOffersInfosJsonAddresses($offers)
//     {
//         $jsonResult = [];

//         if ($offers instanceof ArrayCollection) {
//             $offers = $offers->toArray();
//         }

//         if (is_array($offers)) {
//             foreach ($offers as $offer) {
//                 $jsonResult[] = $offer->getAddress()->getAddressInfos(true);
//             }
//         }

//         return json_encode($jsonResult);
//     }

//     /**
//      * Get Offers Infos in JSON format for all Offers
//      *
//      * @return json
//      */
//     public static function getAllOffersInfosJson()
//     {
//         return self::getOffersInfosJson(self::getOffers());
//     }

//     /**
//      * Get Offers Infos in JSON format for Offers Sorted
//      *
//      * @return json
//      */
//     public static function getOffersSortedInfosJson()
//     {
//         return self::getOffersInfosJson(self::getOffersSorted(self::getOffers(), MAX_OFFERS_TO_DISPLAY));
//     }

//     /**
//      * Get Addresses Infos in JSON format for all Offers
//      *
//      * @return json
//      */
//     public static function getAllOffersAddressesInfosJson()
//     {
//         return self::getOffersInfosJsonAddresses(self::getOffers());
//     }

//     /**
//      * Generate JSON File with All Offers Infos
//      *
//      * @return void
//      */
//     public static function generateJsonFileOffers()
//     {
//         $jsonPath = get_stylesheet_directory() . PATH_JSON_OFFERS;
//         file_put_contents($jsonPath, self::getAllOffersInfosJson());
//     }

//     /**
//      * Generate JSON File with All Offers Infos
//      *
//      * @return void
//      */
//     public static function generateJsonFileOffersSorted()
//     {
//         $jsonPath = get_stylesheet_directory() . PATH_JSON_OFFERS_SORTED;
//         file_put_contents($jsonPath, self::getOffersSortedInfosJson());
//     }

//     /**
//      * Generate JSON File with All Offers Addresses for Map
//      *
//      * @return void
//      */
//     public static function generateJsonFileOffersAddresses()
//     {
//         $jsonPath = get_stylesheet_directory() . PATH_JSON_OFFERS_BY_ADDRESS;
//         file_put_contents($jsonPath, self::getAllOffersAddressesInfosJson());
//     }

//     /**
//      * Generate All JSON Files for Offers
//      *
//      * @return void
//      */
//     public static function generateJsonFilesOffersObjects()
//     {
//         self::generateJsonFileOffers();
//         self::generateJsonFileOffersSorted();
//     }

//     /**
//      * Generate All JSON Files for Offers
//      *
//      * @return void
//      */
//     public static function generateAllJsonFilesOffers()
//     {
//         self::generateJsonFilesOffersObjects();
//         self::generateJsonFileOffersAddresses();
//     }

//     /**
//      * Get Offers Objects from JSON File
//      *
//      * @return ArrayCollection
//      */
//     public static function getOffersFromJson()
//     {
//         $fileUri = get_stylesheet_directory_uri() . PATH_JSON_OFFERS;

//         if (!Utils::isFileExistsFromUrl($fileUri)) {
//             self::generateJsonFileOffers();
//         }

//         return Offer::getObjectsFromJson(json_decode(file_get_contents($fileUri)));
//     }

//     /**
//      * Get Offers Sorted Objects from JSON File
//      *
//      * @return ArrayCollection
//      */
//     public static function getOffersSortedFromJson()
//     {
//         $fileUri = get_stylesheet_directory_uri() . PATH_JSON_OFFERS_SORTED;

//         if (!Utils::isFileExistsFromUrl($fileUri)) {
//             self::generateJsonFileOffersSorted();
//         }

//         return Offer::getObjectsFromJson(json_decode(file_get_contents($fileUri)));
//     }

//     /**
//      * Get All Offers in JSON or XML format
//      *
//      * @return json|xml
//      */
//     public static function getOffersApi($limit = 100)
//     {
//         $offers = self::getOffers(null, $limit)->toArray();

//         $offersForApi = [];

//         foreach ($offers as $offer) {
//             $offersForApi[] = [
//                 'id'                 => $offer->getId(),
//                 'companyName'        => $offer->getCompanyEntity()->getName(),
//                 'companyUrl'         => get_permalink($offer->getCompanyEntity()->getId()),
//                 'companySlug'        => $offer->getCompanyEntity()->getSlug(),
//                 'companyLogo'        => $offer->getCompanyEntity()->getLogo()->getSrc(),
//                 'companyHeaderMedia' => $offer->getCompanyEntity()->getHeaderMedia()->getSrc(),
//                 'title'              => $offer->getTitle(),
//                 'publishDate'        => Utils::getDateTimeFormatted($offer->getPublishDate()),
//                 'contractType'       => $offer->getFormattingContractType(),
//                 'jobTitle'           => $offer->getJobTitle(),
//                 'weeklyHours'        => $offer->getWeeklyHours(),
//                 'levelOfStudy'       => $offer->getLevelOfStudyLabel(),
//                 'experienceRequired' => $offer->getExperienceFull(),
//                 'startASAP'          => $offer->isStartASAP(),
//                 'startDate'          => Utils::getDateTimeFormatted($offer->getStartDate(), 'Y-m-d'),
//                 'salaryMin'          => $offer->getSalaryMin(),
//                 'salaryMax'          => $offer->getSalaryMax(),
//                 'addressName'        => $offer->getAddress()->getName(),
//                 'addressStreet'      => $offer->getAddress()->getStreet(),
//                 'addressCity'        => $offer->getAddress()->getCityName(),
//                 'addressPostalCode'  => $offer->getAddress()->getPostalCode(),
//                 'addressLatitude'    => $offer->getAddress()->getLatitude(),
//                 'addressLongitude'   => $offer->getAddress()->getLongitude(),
//                 'description'        => $offer->getIntroduction(),
//                 'needs'              => $offer->getNeeds(),
//                 'worksWithUs'        => $offer->getWorksWithUs(),
//                 'prospectsWithUs'    => $offer->getProspectsWithUs(),
//                 'recruitmentProcess' => $offer->getRecruitmentProcess(),
//                 'url'                => get_permalink($offer->getId()),
//                 'slug'               => $offer->getSlug(),
//             ];
//         }

//         return $offersForApi;
//     }

//     /**
//      * Get Offers on Lamacompta.co synced from TalentPlug
//      *
//      * @param string $provided '0' for not, '1' for yes, null (default) for all
//      * @param bool   $published
//      *
//      * @return array Array of Offers from TalentPlug, with TalentPlug Offer ID as key
//      */
//     public static function getOffersFromTalentPlug($provided = null, $published = null)
//     {
//         if (in_array($provided, ['0', '1'])) {
//             $metaQuery[] = [
//                 'key'       => 'provided',
//                 'value'     => $provided
//             ];
//         }

//         $args = [
//             'posts_per_page' => -1,
//             'category'    => OFFER_TAG_ID,
//             'author'      => USER_ID_TALENT_PLUG,
//             'post_type'   => 'post',
//             'meta_query'  => $metaQuery,
//             'post_status' => 'any'
//         ];

//         if ($published) {
//             $args['post_status'] = 'publish';
//         }

//         $query = new \WP_Query($args);

//         $offers = Offer::getObjectsFromPosts($query->posts);
//         $offersResult = [];

//         foreach ($offers->toArray() as $offer) {
//             $offersResult[$offer->getTalentPlugOfferId()] = $offer;
//         }

//         return $offersResult;
//     }

//     /**
//      * Get Offer from TalentPlug offer ID if exists on Lamacompta
//      *
//      * @param int $talentPlugOfferId
//      *
//      * @return Offer|null
//      */
//     public static function getOfferFromTalentPlugOfferID($talentPlugOfferId)
//     {
//         $talentPlugOfferId = (int) $talentPlugOfferId;

//         if (!is_int($talentPlugOfferId) || !($talentPlugOfferId > 0)) {
//             return null;
//         }

//         $args = [
//             'category'       => OFFER_TAG_ID,
//             'meta_key'       => ACF_NAME_OFFER_TALENTPLUG_OFFER_ID,
//             'meta_value'     => $talentPlugOfferId,
//             'post_type'      => 'post'
//         ];

//         $query = new \WP_Query($args);

//         if (is_array($query->posts) && count($query->posts) > 0) {
//             $offer = new Offer();

//             return $offer->setObjectFromPost(reset($query->posts));
//         }

//         return null;
//     }

//     /**
//      * Create or Update Post with category "offer" in WordPress.
//      * If given $offer has an ID, it's an update, else a creation.
//      *
//      * @param Offer $offer Offer object to create or update
//      * @param int $author WordPress author (USER_ID_ADMIN = Jason)
//      *
//      * @return int|null ID of the Post which has just been created
//      */
//     public static function createOrUpdateOffer($offer, $oldOffer = null, $author = USER_ID_ADMIN) {
//         remove_action('post_updated', 'wp_save_post_revision');

//         if (!$offer instanceof Offer) {
//             return null;
//         }

//         if (is_null($oldOffer)) {
//             $oldOffer = new Offer();
//         }

//         $postStatus = Offer::$STATUS_DRAFT;

//         if ($offer->hasStatus()) {
//             $postStatus = $offer->getStatus();
//         }

//         $postId = $offer->getId();
//         $postTitle = 'New Offer ' . date('Y-m-d H:i:s');

//         if ($offer->hasTitle()) {
//             $postTitle = wp_strip_all_tags($offer->getTitle());
//         }

//         if (!is_int($postId) || !($postId > 0)) {
//             // Construct Insert options
//             $postData = [
//                 'post_title'    => $postTitle,
//                 'post_type'     => 'post',
//                 'post_status'   => $postStatus,
//                 'post_category' => [OFFER_TAG_ID],
//                 'post_author'   => $author
//             ];

//             $postId = wp_insert_post($postData);
//         } else {
//             $postData = [
//                 'ID'          => $postId,
//                 'post_title'  => $postTitle,
//                 'post_status' => $postStatus
//             ];

//             if ($offer->hasPublishDate()) {
//                 $postData['post_date'] = $offer->getPublishDate()->format('Y-m-d H:i:s');
//             }

//             wp_update_post($postData);
//         }

//         // TalentPlug Offer ID (if provided from TalentPlug)
//         if ($offer->hasTalentPlugOfferId()) {
//             update_field(ACF_ID_OFFER_TALENTPLUG_OFFER_ID, $offer->getTalentPlugOfferId(), $postId);
//         }

//         // Set Provided
//         if ($offer->hasProvided()) {
//             update_field(ACF_ID_OFFER_PROVIDED, (int) $offer->isProvided(), $postId);
//         }

//         // CompanyEntity
//         if ($offer->hasCompanyEntity()) {
//             $companyId = $offer->getCompanyEntity()->getId();

//             update_field(ACF_ID_OFFER_GENERAL_COMPANY, $companyId, $postId);
//         }

//         // ### DETAILS ###
//         $details = [];

//         // Job Title
//         if ($offer->hasJobTitle()) {
//             $details[ACF_ID_OFFER_DETAILS_JOB_TITLE] = $offer->getJobTitleID();
//         }

//         // Contract Type
//         if ($offer->hasContractType()) {
//             $details[ACF_ID_OFFER_DETAILS_CONTRACT_TYPE] = $offer->getContractType();
//         }

//         // Weekly Hours
//         $details[ACF_ID_OFFER_DETAILS_WEEKLY_HOURS] = $offer->getWeeklyHours();

//         // Experience
//         $details[ACF_ID_OFFER_DETAILS_EXPERIENCE] = $offer->getExperience();

//         // Level of study
//         $details[ACF_ID_OFFER_DETAILS_LEVEL_OF_STUDY] = $offer->getLevelOfStudy();

//         // Beginning Contract
//         if ($offer->hasStartASAP()) {
//             $details[ACF_ID_OFFER_DETAILS_CONTRACT_START][ACF_ID_OFFER_DETAILS_CONTRACT_START_ASAP] = $offer->isStartASAP();
//         }

//         $starDate = null;
//         if ($offer->hasStartDate()) {
//             $starDate = $offer->getStartDate()->format('Y-m-d');
//         }

//         $details[ACF_ID_OFFER_DETAILS_CONTRACT_START][ACF_ID_OFFER_DETAILS_CONTRACT_START_DATE] = $starDate;

//         // Salary
//         $details[ACF_ID_OFFER_DETAILS_SALARY][ACF_ID_OFFER_DETAILS_SALARY_MIN] = $offer->getSalaryMin();
//         $details[ACF_ID_OFFER_DETAILS_SALARY][ACF_ID_OFFER_DETAILS_SALARY_MAX] = $offer->getSalaryMax();

//         // Address
//         if ($offer->hasAddress()) {
//             $address = $offer->getAddress();

//             if ($address->hasName()) {
//                 $details[ACF_ID_OFFER_DETAILS_ADDRESS][ACF_ID_OFFER_DETAILS_ADDRESS_NAME] = $address->getName();
//             }

//             if ($address->hasStreet()) {
//                 $details[ACF_ID_OFFER_DETAILS_ADDRESS][ACF_ID_OFFER_DETAILS_ADDRESS_STREET] = $address->getStreet();
//             }

//             if ($address->hasCity()) {
//                 $details[ACF_ID_OFFER_DETAILS_ADDRESS][ACF_ID_OFFER_DETAILS_ADDRESS_CITY] = $address->getCityId();
//             }

//             if ($address->hasPostalCode()) {
//                 $details[ACF_ID_OFFER_DETAILS_ADDRESS][ACF_ID_OFFER_DETAILS_ADDRESS_POSTAL] = $address->getPostalCode();
//             }

//             $details[ACF_ID_OFFER_DETAILS_ADDRESS][ACF_ID_OFFER_DETAILS_ADDRESS_HR_MAIL] = $address->getHrMailAddress();

//             if ($address->hasLatitude()) {
//                 $details[ACF_ID_OFFER_DETAILS_ADDRESS][ACF_ID_OFFER_DETAILS_ADDRESS_LAT] = $address->getLatitude();
//             }

//             if ($address->hasLongitude()) {
//                 $details[ACF_ID_OFFER_DETAILS_ADDRESS][ACF_ID_OFFER_DETAILS_ADDRESS_LNG] = $address->getLongitude();
//             }
//         }

//         // -- Update ACF Fields for Details
//         update_field(ACF_ID_OFFER_DETAILS, $details, $postId);
//         // ### /DETAILS ###

//         // ### THE MISSIONS ###
//         $theMissions = [];

//         if ($offer->hasIntroduction()) {
//             $theMissions[ACF_ID_OFFER_THE_MISSIONS_INTRO] = $offer->getIntroduction();
//         }

//         $theMissions[ACF_ID_OFFER_THE_MISSIONS_MISSIONS_TEXT] = $offer->getMissions();

//         // -- Update ACF Fields for The Missions
//         update_field(ACF_ID_OFFER_THE_MISSIONS, $theMissions, $postId);
//         // ### /THE MISSIONS ###


//         // ### OTHERS ###
//         // Tools
//         $tools = [];
//         if ($offer->hasTools()) {
//             $tools = $offer->getTools()->toArray();
//         }

//         update_field(ACF_ID_OFFER_OTHERS_TOOLS, $tools, $postId);

//         // Job Needs
//         update_field(ACF_ID_OFFER_OTHERS_JOB_NEEDS, $offer->getNeeds(), $postId);

//         // Works with us
//         update_field(ACF_ID_OFFER_OTHERS_WORKS_WITH_US, $offer->getWorksWithUs(), $postId);

//         // Prospects With Us
//         update_field(ACF_ID_OFFER_OTHERS_PROSPECTS_WITH_US, $offer->getProspectsWithUs(), $postId);

//         // Recruitment Process
//         update_field(ACF_ID_OFFER_OTHERS_RECRUITMENT_PROCESS, $offer->getRecruitmentProcess(), $postId);
//         // ### /OTHERS ###

//         add_action('post_updated', 'wp_save_post_revision');

//         return $postId;
//     }

//     /**
//      * Check if Keywords filter is valid
//      *
//      * @param string $fKeywords Keywords filter
//      *
//      * @return bool
//      */
//     public static function isValidFilterKeywords($fKeywords)
//     {
//         return is_string($fKeywords);
//     }

//     /**
//      * Check if Job Titles filter is valid
//      *
//      * @param array $fJobTitles Job Titles filter
//      *
//      * @return bool
//      */
//     public static function isValidFilterJobTitles($fJobTitles)
//     {
//         if (!is_array($fJobTitles)) {
//             return false;
//         }

//         $isOk = true;
//         foreach ($fJobTitles as $jobTitle) {
//             if (!Offer::isJobTitle($jobTitle)) {
//                 $isOk = false;
//             }
//         }

//         return $isOk;
//     }

//     /**
//      * Check if Contract Types filter is valid
//      *
//      * @param array $fContractTypes Contract Types filter
//      *
//      * @return bool
//      */
//     public static function isValidFilterContractTypes($fContractTypes)
//     {
//         if (!is_array($fContractTypes)) {
//             return false;
//         }

//         $isOk = true;
//         foreach ($fContractTypes as $contractType) {
//             if (!Offer::isContractType($contractType)) {
//                 $isOk = false;
//             }
//         }

//         return $isOk;
//     }

//     /**
//      * Check if Cities filter is valid
//      *
//      * @param array $fCitiesAndDept Cities filter
//      *
//      * @return bool
//      */
//     public static function isValidFilterCitiesOrDept($fCitiesAndDept)
//     {
//         if (!is_array($fCitiesAndDept)) {
//             return false;
//         }

//         $isOk = true;
//         foreach ($fCitiesAndDept as $value) {
//             if (!is_string($value) || !is_int((int)$value)) {
//                 $isOk = false;
//             }
//         }

//         return $isOk;
//     }

//     /**
//      * Check if candidate Experience filter is valid
//      *
//      * @param array $fExperiences candidate Experience filter
//      *
//      * @return bool
//      */
//     public static function isValidFilterExperiences($fExperiences)
//     {
//         if (!is_array($fExperiences)) {
//             return false;
//         }

//         $isOk = true;
//         foreach ($fExperiences as $experience) {
//             if (!Offer::isExperience($experience)) {
//                 $isOk = false;
//             }
//         }

//         return $isOk;
//     }
}
