<?php

namespace App\Repository;

// use Elements\Atoms\Media;
// use App\Entity\Company\Entity\CompanyEntity;
// use App\Entity\Organisation;
// use App\Entity\Parrain;
// use App\Entity\TeamMember;
// use Elements\HTMLElements\Image;
// use Doctrine\Common\Collections\ArrayCollection;
// use App\Utils\Functional;
// use App\Utils\Utils;

class CompanyRepository
{
//     /**
//      * Get the given WP_Post CompanyEntity as a CompanyEntity entity object
//      *
//      * @param mixed $target WP_Post or WP_Post ID
//      *
//      * @return CompanyEntity
//      */
//     public static function getCompanyEntity($target)
//     {
//         $companyWP = get_post($target);
//         $company   = new CompanyEntity();
//         $company->setObjectFromPost($companyWP);

//         return $company;
//     }

//     /**
//      * Get all companies or companies with id in given $ids
//      *
//      * @param array|null $ids CompanyEntity ids asked
//      *
//      * @return ArrayCollection Posts array
//      */
//     public static function getCompanies($ids = null, $limit = -1, $light = false, $onlyPremium = false, $sorted = true)
//     {
//         $metaQuery = [];

//         if ($onlyPremium) {
//             $metaQuery[] = [
//                 'key'       => 'premium',
//                 'value'     => '1'
//             ];
//         }

//         $args = [
//             'posts_per_page' => -1,
//             'post_status'    => 'publish',
//             'category_name'  => COMPANY_TAG_SLUG,
//             'post__in'       => $ids,
//             'post__not_in'   => [POST_ID_EXAMPLE_COMPANY_PAGE, POST_ID_LAMACOMPTA_PAGE],
//             'meta_query'     => $metaQuery,
//             'orderby'        => ['meta_value' => 'DESC', 'post_title' => 'ASC']
//         ];

//         $query = new \WP_Query($args);

//         $companies = CompanyEntity::getObjectsFromPosts($query->posts, $light);

//         // self::dumpCompanies($companies);
//         // self::dumpCompanies(self::getCompaniesSorted($companies));

//         if ($sorted) {
//             return self::getCompaniesSorted($companies, $limit);
//         }

//         if ($limit > -1) {
//             $companies = Utils::createArrayCollection($companies->slice(0, $limit));
//         }

//         return $companies;
//     }

//     /**
//      * Get all companies with light information
//      *
//      * @param array|null $ids CompanyEntity ids asked
//      *
//      * @return ArrayCollection Posts array
//      */
//     public static function getCompaniesLight($ids = null, $limit = -1, $onlyPremium = false, $sorted = true)
//     {
//         return self::getCompanies($ids, $limit, true, $onlyPremium, $sorted);
//     }

//     /**
//      * Get Companies depends on fitlers
//      *
//      * @param array $filters Filters on fields (view Repository::buildWhere)
//      *
//      * @return ArrayCollection
//      */
//     public static function getCompaniesByFilters($filters, $idsToExclude = [])
//     {
//         $fPostTitle     = Repository::getFilterValue($filters, 'keywords');
//         $fWorkforce     = Repository::getFilterValue($filters, 'workforce');
//         $fCitiesAndDept = Repository::getFilterValue($filters, 'cities_and_dept');
//         $fJobTypes      = Repository::getFilterValue($filters, 'job_types');
//         $fBadges        = Repository::getFilterValue($filters, 'badges');

//         $metaQuery      = [];

//         if (self::isValidFilterWorkforce($fWorkforce)) {

//             $workforcesFilter = [];

//             foreach ($fWorkforce as $wf) {
//                 if ($wf == '1') {
//                     $workforcesFilter[] = '1';
//                     $workforcesFilter[] = '2';
//                 }

//                 if ($wf == '2') {
//                     $workforcesFilter[] = '3';
//                     $workforcesFilter[] = '4';
//                     $workforcesFilter[] = '5';
//                     $workforcesFilter[] = '6';
//                     $workforcesFilter[] = '7';
//                 }

//                 if ($wf == '3') {
//                     $workforcesFilter[] = '8';
//                     $workforcesFilter[] = '9';
//                     $workforcesFilter[] = '10';
//                     $workforcesFilter[] = '11';
//                 }
//             }

//             $metaQuery[] = [
//                 'key'       => 'team_workforce',
//                 'value'     => $workforcesFilter,
//                 'compare'   => 'IN'
//             ];
//         }

//         if (self::isValidFilterCitiesOrDept($fCitiesAndDept)) {
//             $metaQueryCities = [];

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

//             $metaQueryCities[] = [
//                 'key'       => 'permises_addresses_$_city',
//                 'value'     => $fCities,
//                 'compare'   => 'IN'
//             ];

//             $metaQuery[] = $metaQueryCities;
//         }

//         if (self::isValidFilterJobTypes($fJobTypes)) {
//             $metaQueryJobTypes = [];

//             foreach ($fJobTypes as $fJobType) {
//                 $metaQueryJobTypes[] = [
//                     'key'       => 'activity_our_jobs_types',
//                     'value'     => $fJobType,
//                     'compare'   => 'LIKE'
//                 ];
//             }

//             if (count($fJobTypes) > 1) {
//                 $metaQueryJobTypes['relation'] = 'OR';
//             } else {
//                 $metaQueryJobTypes = reset($metaQueryJobTypes);
//             }

//             $metaQuery[] = $metaQueryJobTypes;
//         }

//         if (self::isValidFilterBadges($fBadges)) {
//             $metaQueryBadges = [];

//             foreach ($fBadges as $fBadge) {
//                 $metaQueryBadges[] = [
//                     'key'       => 'activity_badges',
//                     'value'     => "\"$fBadge\"",
//                     'compare'   => 'LIKE'
//                 ];
//             }

//             if (count($fBadges) > 1) {
//                 $metaQueryBadges['relation'] = 'AND';
//             } else {
//                 $metaQueryBadges = reset($metaQueryBadges);
//             }

//             $metaQuery[] = $metaQueryBadges;
//         }

//         $idsToExclude[] = POST_ID_EXAMPLE_COMPANY_PAGE;
//         $idsToExclude[] = POST_ID_LAMACOMPTA_PAGE;

//         $args = [
//             'posts_per_page'    => -1,
//             'post_type'         => 'post',
//             'post_status'       => 'publish',
//             'category_name'     => COMPANY_TAG_SLUG,
//             'post__not_in'      => $idsToExclude,
//             'search_post_title' => $fPostTitle,
//             'meta_query'        => $metaQuery,
//             'meta_key'          => 'premium',
//             'orderby'           => ['meta_value' => 'DESC', 'post_title' => 'ASC']
//         ];

//         add_filter('posts_where', ['App\Repository\Repository', 'setWPPostTitleFilter'], 10, 2);
//         $query = new \WP_Query($args);
//         remove_filter('posts_where', ['App\Repository\Repository', 'setWPPostTitleFilter'], 10);

//         $companies = CompanyEntity::getObjectsFromPosts($query->posts);

//         return self::getCompaniesSorted($companies);
//     }

//     /**
//      * Sort given companies with functional rules
//      *
//      * @param ArrayCollection $companies Offers to sort
//      *
//      * @return ArrayCollection
//      */
//     public static function getCompaniesSorted($companies, $limit = -1)
//     {
//         if ($companies instanceof ArrayCollection) {
//             $companies = $companies->toArray();
//         }

//         if (is_array($companies)) {
//             // Shuffle companies with same weight
//             shuffle($companies);

//             // Define weight for each company
//             foreach ($companies as $key => $company) {
//                 $weight = 1;

//                 $nbOffers = OfferRepository::getNumberOffersForCompanyEntity($company->getId());
//                 $nbBadges = $company->getNbBadges();

//                 if ($company->hasHeaderMedia()) {
//                     $weight += 30;
//                 }

//                 if ($nbOffers > 0) {
//                     $weight += 15;
//                 }

//                 if ($nbBadges > 0) {
//                     $weight += 10;
//                 }

//                 if ($company->isOpenToRecruitment()) {
//                     $weight += 35;
//                 }

//                 // Premium always displayed first
//                 if ($company->isPremium()) {
//                     $weight = $weight * 10000;
//                 }

//                 $companies[$key]->weight = $weight;
//             }

//             // Sort $companies depending $weights
//             usort($companies, function ($companyA, $companyB) {
//                 return $companyB->weight <=> $companyA->weight;
//             });
//         }

//         if ($limit > -1 && is_array($companies)) {
//             $companies = array_slice($companies, 0, $limit);
//         }

//         return Utils::createArrayCollection($companies);
//     }

//     /**
//      * Get Companies Ids from the given list of companies
//      *
//      * @param ArrayCollection|array $companies Companies to use
//      *
//      * @return array
//      */
//     public static function getCompaniesIds($companies)
//     {
//         $ids = [];

//         if ($companies instanceof ArrayCollection) {
//             $companies = $companies->toArray();
//         }

//         if (is_array($companies)) {
//             foreach ($companies as $company) {
//                 if ($company instanceof CompanyEntity) {
//                     $ids[] = $company->getId();
//                 }
//             }
//         }

//         return $ids;
//     }

//     /**
//      * Get Companies List with ID in keys and Name in value, from given companies
//      *
//      * @param ArrayCollection|array $companies
//      *
//      * @return array
//      */
//     public static function getCompaniesList($companies = null)
//     {
//         $infos = [];

//         if (is_null($companies)) {
//             $companies = self::getCompanies();
//         }

//         if ($companies instanceof ArrayCollection) {
//             $companies = $companies->toArray();
//         }

//         foreach ($companies as $company) {
//             if ($company instanceof CompanyEntity) {
//                 $infos[$company->getId()] = $company->getName();
//             }
//         }

//         return $infos;
//     }

//     /**
//      * Get CompanyEntity Object from CompanyEntity Name
//      *
//      * @param string $companyName
//      *
//      * @return CompanyEntity|null
//      */
//     public static function getCompanyEntityFromName($companyName)
//     {
//         $filters['keywords'] = [
//             'field' => 'keywords',
//             'value' => $companyName
//         ];

//         $company = self::getCompaniesByFilters($filters);

//         if ($company instanceof ArrayCollection && $company->count() > 0) {
//             return $company->first();
//         }

//         return null;
//     }

//     /**
//      * Get Companies Objects from keywords on CompanyEntity Name
//      *
//      * @param string $keywords
//      *
//      * @return ArrayCollection<CompanyEntity>|ArrayCollection
//      */
//     public static function getCompaniesFromName($keywords)
//     {
//         $filters['keywords'] = [
//             'field' => 'keywords',
//             'value' => $keywords
//         ];

//         $companies = self::getCompaniesByFilters($filters);

//         if ($companies instanceof ArrayCollection && $companies->count() > 0) {
//             return $companies;
//         }

//         return new ArrayCollection;
//     }

//     /**
//      * Dump Companies for technical maintenance
//      *
//      * @param ArrayCollection $companies Companies to dump
//      *
//      * @return void
//      */
//     public static function dumpCompanies($companies)
//     {
//         if ($companies instanceof ArrayCollection) {
//             $companies = $companies->toArray();
//         }

//         if (is_array($companies)) {
//             foreach ($companies as $company) {
//                 echo $company->getName() . ' - '
//                 . ($company->isPremium() ? 'PREMIUM !' : 'Free')
//                 . ' | Nb offres : ' . $company->getOffers()->count()
//                 . ' | Nb badges : ' . $company->getBadges()->count()
//                 . '<br>';
//             }
//         }

//         echo '<br><br>';
//     }

//     /**
//      * Create or Update Post with category "company" in WordPress.
//      * If given $company has an ID, it's an update, else a creation.
//      *
//      * @param CompanyEntity $company CompanyEntity object to create or update
//      * @param CompanyEntity|null $oldCompanyEntity Old CompanyEntity object to replace
//      * @param int $author WordPress author (USER_ID_ADMIN = Jason)
//      *
//      * @return int|null ID of the Post which has just been created
//      */
//     public static function createOrUpdateCompanyEntity($company, $oldCompanyEntity = null, $author = USER_ID_ADMIN)
//     {
//         remove_action('post_updated', 'wp_save_post_revision');

//         if (!$company instanceof CompanyEntity) {
//             return null;
//         }

//         if (is_null($oldCompanyEntity)) {
//             $oldCompanyEntity = new CompanyEntity();
//         }

//         $postStatus = CompanyEntity::$STATUS_DRAFT;

//         if ($company->hasStatus()) {
//             $postStatus = $company->getStatus();
//         }

//         $postId = $company->getId();
//         $postTitle = 'New CompanyEntity ' . date('Y-m-d H:i:s');

//         if ($company->hasName()) {
//             $postTitle = wp_strip_all_tags($company->getName());
//         }

//         if (!is_int($postId) || !($postId > 0)) {
//             // Construct Insert options
//             $postData = [
//                 'post_title'    => $postTitle,
//                 'post_type'     => 'post',
//                 'post_status'   => $postStatus,
//                 'post_category' => [COMPANY_TAG_ID],
//                 'post_author'   => $author
//             ];

//             $postId = wp_insert_post($postData);
//         } else {
//             $postData = [
//                 'ID'         => $postId,
//                 'post_title' => $postTitle,
//                 'post_status'  => $postStatus
//             ];

//             wp_update_post($postData);
//         }

//         $mediasToDelete = [];

//         // Premium
//         if ($company->hasPremium()) {
//             update_field(ACF_ID_COMPANY_PREMIUM, $company->isPremium(), $postId);
//         }

//         // Open to Recruitment
//         if ($company->hasOpenToRecruitment()) {
//             update_field(ACF_ID_COMPANY_RECRUITMENT, $company->isOpenToRecruitment(), $postId);
//         }

//         // Code Parrain
//         if ($company->hasCodeParrain()) {
//             $codeParrain = $company->getCodeParrain();
//         } else {
//             $codeParrain = Parrain::generateCodeParrain($company);
//             $company->setCodeParrain($codeParrain);
//         }

//         update_field(ACF_ID_COMPANY_CODE_PARRAIN, $codeParrain, $postId);

//         // ### IDENTITY ###
//         $identity = [];

//         // -- General
//         // Logo
//         if ($company->hasLogo() && $company->getLogo()->hasId()) {
//             $identity[ACF_ID_COMPANY_IDENTITY_LOGO] = $company->getLogo()->getId();
//         }

//         // Creation Year
//         $identity[ACF_ID_COMPANY_IDENTITY_CREATION_YEAR] = $company->getCreationYear();

//         // Global HR Mail Address
//         $identity[ACF_ID_COMPANY_IDENTITY_HR_MAIL] = $company->getGlobalHrMailAddress();

//         // Turnover
//         $identity[ACF_ID_COMPANY_IDENTITY_TURNOVER] = $company->getTurnover();

//         // -- /General

//         // -- Illustrations
//         // Header Illustration
//         $headerMediaId = null;

//         if ($company->hasHeaderMedia() && $company->getHeaderMedia()->hasId()) {
//             $headerMediaId = $company->getHeaderMedia()->getId();
//         }

//         $identity[ACF_ID_COMPANY_IDENTITY_HEADER_ILLU] = $headerMediaId;

//         // Main Illustration
//         $mainMedia = [];
//         $mainMedia[ACF_ID_COMPANY_IDENTITY_MAIN_ILLU_MEDIA_TYPE]  = Media::ACF_IS_IMAGE;
//         $mainMedia[ACF_ID_COMPANY_IDENTITY_MAIN_ILLU_MEDIA_IMAGE] = null;
//         $mainMedia[ACF_ID_COMPANY_IDENTITY_MAIN_ILLU_MEDIA_VIDEO] = null;

//         if ($company->hasMainMedia() && ($company->getMainMedia()->hasId() || $company->getMainMedia()->hasSrc())) {

//             if ($company->getMainMedia()->isImage()) {
//                 $mainMedia[ACF_ID_COMPANY_IDENTITY_MAIN_ILLU_MEDIA_TYPE] = Media::ACF_IS_IMAGE;
//                 $mainMedia[ACF_ID_COMPANY_IDENTITY_MAIN_ILLU_MEDIA_IMAGE] = $company->getMainMedia()->getId();
//             }

//             if ($company->getMainMedia()->isVideo()) {
//                 $mainMedia[ACF_ID_COMPANY_IDENTITY_MAIN_ILLU_MEDIA_TYPE] = Media::ACF_IS_VIDEO;
//                 $mainMedia[ACF_ID_COMPANY_IDENTITY_MAIN_ILLU_MEDIA_VIDEO] = $company->getMainMedia()->getSrc();
//             }
//         }

//         $identity[ACF_ID_COMPANY_IDENTITY_MAIN_ILLU][ACF_ID_COMPANY_IDENTITY_MAIN_ILLU_MEDIA] = $mainMedia;
//         // -- /Illustrations

//         // -- The CompanyEntity
//         // Who we are
//         $whoWeAre = [];

//         $whoWeAre[ACF_ID_COMPANY_IDENTITY_WHO_WE_ARE_TEXT] = $company->getUsText();

//         $usImageId = null;
//         if ($company->hasUsImage() && $company->getUsImage()->hasId()) {
//             $usImageId = $company->getUsImage()->getId();
//         }

//         $whoWeAre[ACF_ID_COMPANY_IDENTITY_WHO_WE_ARE_ILLU] = $usImageId;

//         $identity[ACF_ID_COMPANY_IDENTITY_WHO_WE_ARE] = $whoWeAre;

//         // Values
//         if ($company->hasValues()) {
//             $identity[ACF_ID_COMPANY_IDENTITY_VALUES] = $company->getValues();
//         }

//         // -- /Illustrations

//         // Update IDENTITY
//         if (!empty($identity)) {
//             update_field(ACF_ID_COMPANY_IDENTITY, $identity, $postId);
//         }

//         // ### /IDENTITY ###

//         // ### ACTIVITY ###
//         $activity = [];

//         $tools = [];
//         if ($company->hasTools()) {
//             $tools = $company->getTools()->toArray();
//         }

//         $activity[ACF_ID_COMPANY_ACTIVITY_TOOLS] = $tools;

//         $jobTypes = [];
//         if ($company->hasJobTypes()) {
//             $jobTypes = $company->getJobTypes()->toArray();
//         }

//         $activity[ACF_ID_COMPANY_ACTIVITY_JOBS_TYPES] = $jobTypes;

//         $customerDesc = '';
//         if ($company->hasCustomerDesc()) {
//             $customerDesc = $company->getCustomerDesc();
//         }

//         $activity[ACF_ID_COMPANY_ACTIVITY_CUST_DESC] = $customerDesc;

//         $customerNumber = null;
//         if ($company->hasCustomerNumber()) {
//             $customerNumber = $company->getCustomerNumber();
//         }

//         $activity[ACF_ID_COMPANY_ACTIVITY_CUST_NB] = $customerNumber;

//         $badgesIds = [];
//         if ($company->hasBadges()) {
//             foreach ($company->getBadges()->toArray() as $badge) {
//                 $badgesIds[] = $badge->getId();
//             }
//         }

//         $activity[ACF_ID_COMPANY_ACTIVITY_BADGES] = $badgesIds;


//         if (!empty($activity)) {
//             update_field(ACF_ID_COMPANY_ACTIVITY, $activity, $postId);
//         }
//         // ### /ACTIVITY ###

//         // ### PERMISES ###
//         $permises = [];

//         // Permises Addresses
//         $permises[ACF_ID_COMPANY_PERMISES_ADDRESSES] = [];
//         if ($company->hasAddresses()) {
//             $addresses = $company->getAddresses();

//             foreach ($addresses->toArray() as $address) {
//                 $addressACF = [];

//                 if ($address->hasName()) {
//                     $addressACF[ACF_ID_COMPANY_PERMISES_ADDRESSES_NAME] = $address->getName();
//                 }

//                 if ($address->hasStreet()) {
//                     $addressACF[ACF_ID_COMPANY_PERMISES_ADDRESSES_STREET] = $address->getStreet();
//                 }

//                 if ($address->hasCity()) {
//                     $addressACF[ACF_ID_COMPANY_PERMISES_ADDRESSES_CITY_ID] = $address->getCityId();
//                 }

//                 if ($address->hasPostalCode()) {
//                     $addressACF[ACF_ID_COMPANY_PERMISES_ADDRESSES_POSTAL] = $address->getPostalCode();
//                 }

//                 if ($address->hasHrMailAddress()) {
//                     $addressACF[ACF_ID_COMPANY_PERMISES_ADDRESSES_HR_MAIL] = $address->getHrMailAddress();
//                 }

//                 if ($address->hasLatitude()) {
//                     $addressACF[ACF_ID_COMPANY_PERMISES_ADDRESSES_LAT] = $address->getLatitude();
//                 }

//                 if ($address->hasLongitude()) {
//                     $addressACF[ACF_ID_COMPANY_PERMISES_ADDRESSES_LNG] = $address->getLongitude();
//                 }

//                 if (!empty($addressACF)) {
//                     $permises[ACF_ID_COMPANY_PERMISES_ADDRESSES][] = $addressACF;
//                 }
//             }
//         }

//         // Permises (Offices) Medias
//         $permises[ACF_ID_COMPANY_PERMISES_MEDIAS] = [];

//         if ($company->hasOfficesMedias()) {
//             $officesMedias = $company->getOfficesMedias();

//             foreach($officesMedias->toArray() as $officesMedia) {
//                 $officeMedia = [];
//                 $media = Utils::getProp('media', $officesMedia);
//                 $caption = Utils::getProp('caption', $officesMedia);

//                 if ($media instanceof Media && ($media->hasId() || $media->hasSrc())) {
//                     $illu = [];

//                     if ($media->isImage()) {
//                         $illu[ACF_ID_COMPANY_PERMISES_MEDIAS_ILLU_MEDIA_TYPE] = Media::ACF_IS_IMAGE;
//                         $illu[ACF_ID_COMPANY_PERMISES_MEDIAS_ILLU_MEDIA_IMAGE] = $media->getId();
//                     }

//                     if ($media->isVideo()) {
//                         $illu[ACF_ID_COMPANY_PERMISES_MEDIAS_ILLU_MEDIA_TYPE] = Media::ACF_IS_VIDEO;
//                         $illu[ACF_ID_COMPANY_PERMISES_MEDIAS_ILLU_MEDIA_VIDEO] = $media->getSrc();
//                     }

//                     $officeMedia[ACF_ID_COMPANY_PERMISES_MEDIAS_ILLU] = $illu;
//                     $officeMedia[ACF_ID_COMPANY_PERMISES_MEDIAS_CAPTION] = $caption;

//                     $permises[ACF_ID_COMPANY_PERMISES_MEDIAS][] = $officeMedia;
//                 }
//             }

//             // Clean old medias
//             if ($oldCompanyEntity->hasOfficesMedias()) {
//                 foreach ($oldCompanyEntity->getOfficesMedias()->toArray() as $media) {
//                     $media = Utils::getProp('media', $media);

//                     if ($media instanceof Media && $media->hasId()) {
//                         $mediasToDelete[] = $media->getId();
//                     }
//                 }
//             }
//         }

//         // -- Update ACF Fields for Permises
//         if (!empty($permises)) {
//             update_field(ACF_ID_COMPANY_PERMISES, $permises, $postId);
//         }
//         // ### /PERMISES ###

//         // ### TEAM ###
//         $team = [];

//         // Workforce
//         $team[ACF_ID_COMPANY_TEAM_WORKFORCE] = $company->getWorkforce();

//         // Middle age
//         $team[ACF_ID_COMPANY_TEAM_AGE] = $company->getMiddleAge();

//         // -- The Team
//         // Introduction
//         $team[ACF_ID_COMPANY_TEAM_INTRO] = $company->getTeamIntro();

//         // Team Medias
//         $team[ACF_ID_COMPANY_TEAM_MEDIAS] = [];

//         if ($company->hasTeamMedias()) {
//             $teamMedias = $company->getTeamMedias();

//             foreach ($teamMedias->toArray() as $tm) {
//                 $teamMedia = [];

//                 $mediaSource = Utils::getProp('media', $tm);

//                 if ($mediaSource instanceof Media && ($mediaSource->hasId() || $mediaSource->hasSrc())) {
//                     $media = [];

//                     if ($mediaSource->isImage()) {
//                         $media[ACF_ID_COMPANY_TEAM_MEDIAS_MEDIA_TYPE] = Media::ACF_IS_IMAGE;
//                         $media[ACF_ID_COMPANY_TEAM_MEDIAS_MEDIA_IMAGE] = $mediaSource->getId();
//                     }

//                     if ($mediaSource->isVideo()) {
//                         $media[ACF_ID_COMPANY_TEAM_MEDIAS_MEDIA_TYPE] = Media::ACF_IS_VIDEO;
//                         $media[ACF_ID_COMPANY_TEAM_MEDIAS_MEDIA_VIDEO] = $mediaSource->getSrc();
//                     }

//                     $teamMedia[ACF_ID_COMPANY_TEAM_MEDIAS_TITLE] = Utils::getProp('title', $tm);
//                     $teamMedia[ACF_ID_COMPANY_TEAM_MEDIAS_MEDIA . '_' . ACF_ID_GLOBAL_MEDIA] = $media;
//                     $teamMedia[ACF_ID_COMPANY_TEAM_MEDIAS_DESC] = Utils::getProp('desc', $tm);

//                     $team[ACF_ID_COMPANY_TEAM_MEDIAS][] = $teamMedia;
//                 }
//             }

//             // Clean old medias
//             if ($oldCompanyEntity->hasTeamMedias()) {
//                 foreach ($oldCompanyEntity->getTeamMedias()->toArray() as $tm) {
//                     $media = Utils::getArrayValue(ACF_ID_COMPANY_TEAM_MEDIAS_MEDIA, $tm);

//                     if ($media instanceof Media && $media->hasId()) {
//                         $mediasToDelete[] = $media->getId();
//                     }
//                 }
//             }
//         }

//         // Team Members
//         $team[ACF_ID_COMPANY_TEAM_MEMBERS] = [];

//         if ($company->hasTeamMembers()) {
//             $teamMembers = $company->getTeamMembers();

//             foreach ($teamMembers->toArray() as $teamMember) {
//                 $teamMemberACF = [];

//                 if ($teamMember instanceof TeamMember) {
//                     if ($teamMember->hasName()) {
//                         $teamMemberACF[ACF_ID_COMPANY_TEAM_MEMBERS_NAME] = $teamMember->getName();
//                     }

//                     if ($teamMember->hasPhoto() && $teamMember->getPhoto()->hasId()) {
//                         $teamMemberACF[ACF_ID_COMPANY_TEAM_MEMBERS_PHOTO] = $teamMember->getPhoto()->getId();
//                     }

//                     if ($teamMember->hasJob()) {
//                         $teamMemberACF[ACF_ID_COMPANY_TEAM_MEMBERS_JOB] = $teamMember->getJob();
//                     }

//                     if ($teamMember->hasDescription()) {
//                         $teamMemberACF[ACF_ID_COMPANY_TEAM_MEMBERS_DESC] = $teamMember->getDescription();
//                     }

//                     if ($teamMember->hasSkills()) {
//                         foreach ($teamMember->getSkills()->toArray() as $skill) {
//                             $teamMemberACF[ACF_ID_COMPANY_TEAM_MEMBERS_SKILLS][][ACF_ID_COMPANY_TEAM_MEMBERS_SKILLS_SKILL] = $skill;
//                         }
//                     }

//                     if ($teamMember->hasLinkedin()) {
//                         $teamMemberACF[ACF_ID_COMPANY_TEAM_MEMBERS_LINKEDIN] = $teamMember->getLinkedin();
//                     }
//                 }

//                 $team[ACF_ID_COMPANY_TEAM_MEMBERS][] = $teamMemberACF;
//             }

//             // Clean old medias
//             if ($oldCompanyEntity->hasTeamMembers()) {
//                 foreach ($oldCompanyEntity->getTeamMembers()->toArray() as $teamMember) {
//                     if ($teamMember->hasPhoto() && $teamMember->getPhoto()->hasId()) {
//                         $mediasToDelete[] = $teamMember->getPhoto()->getId();
//                     }
//                 }
//             }
//         }

//         if (!empty($team)) {
//             update_field(ACF_ID_COMPANY_TEAM, $team, $postId);
//         }

//         // ### /TEAM ###

//         // ### COMMUNICATION & NETWORK ###
//         $comm = [];

//         // Website
//         $comm[ACF_ID_COMPANY_COMM_WEBSITE] = $company->getWebsite();

//         // -- Social Networks
//         $sn = [];

//         if ($company->hasSocial()) {
//             $social = $company->getSocial();

//             $sn[ACF_ID_COMPANY_COMM_SN_LINKEDIN]  = $social->getLinkedin();
//             $sn[ACF_ID_COMPANY_COMM_SN_TWITTER]   = $social->getTwitter();
//             $sn[ACF_ID_COMPANY_COMM_SN_FACEBOOK]  = $social->getFacebook();
//             $sn[ACF_ID_COMPANY_COMM_SN_INSTAGRAM] = $social->getInstagram();
//             $sn[ACF_ID_COMPANY_COMM_SN_YOUTUBE]   = $social->getYoutube();

//         }

//         $comm[ACF_ID_COMPANY_COMM_SN] = $sn;

//         // -- Ecosystem
//         $ecosystem = [];

//         if ($company->hasEcosystem()) {
//             foreach ($company->getEcosystem()->toArray() as $partner) {
//                 if ($partner instanceof Organisation) {
//                     $ecosystem[] = $partner->getId();
//                 }
//             }
//         }

//         $comm[ACF_ID_COMPANY_COMM_ECOSYSTEM] = $ecosystem;
//         // ### /COMMUNICATION & NETWORK ###

//         if (!empty($comm)) {
//             update_field(ACF_ID_COMPANY_COMM, $comm, $postId);
//         }

//         Functional::removeAttachments($mediasToDelete);

//         add_action('post_updated', 'wp_save_post_revision');

//         return $postId;
//     }

//     /**
//      * Get number of total Companies
//      *
//      * @return int Number of Companies
//      */
//     public static function getNbCompanies()
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();

//         $idExampleCompanyEntity = POST_ID_EXAMPLE_COMPANY_PAGE;
//         $idLamacomptaPage = POST_ID_LAMACOMPTA_PAGE;
//         $idCompanyEntityTag     = COMPANY_TAG_ID;

//         $sql = "SELECT count(p.ID) AS nb_companies
//                 FROM $db->posts AS p
//                 INNER JOIN $db->term_relationships AS tr
//                     ON p.ID = tr.object_id AND tr.term_taxonomy_id = $idCompanyEntityTag
//                 WHERE p.ID NOT IN ($idExampleCompanyEntity, $idLamacomptaPage)
//                     AND p.post_type = 'post'
//                     AND p.post_status = 'publish'
//         ";

//         return (int) $db->get_row($sql)->nb_companies;
//     }

//     /**
//      * Get Header Media for the given CompanyEntity
//      *
//      * @param int $companyId
//      *
//      * @return Media|null
//      */
//     public static function getHeaderMediaByCompanyEntity($companyId)
//     {
//         $mediaUri = self::getACFImagesUriByPostsId([$companyId], 'identity_header_illu');

//         if (is_array($mediaUri) && array_key_exists(0, $mediaUri)) {
//             return new Media($mediaUri[0]);
//         }

//         return null;
//     }

//     /**
//      * Get Logo for the given CompanyEntity
//      *
//      * @param int $companyId
//      *
//      * @return Media|null
//      */
//     public static function getLogoByCompanyEntity($companyId)
//     {
//         $mediaUri = self::getACFImagesUriByPostsId([$companyId], 'identity_logo');

//         if (is_array($mediaUri) && array_key_exists(0, $mediaUri)) {
//             return new Media($mediaUri[0]);
//         }

//         return null;
//     }

//     /**
//      * Get CompanyEntity Infos for the given CompanyEntity
//      *
//      * @param int $companyId
//      *
//      * @return array
//      */
//     public static function getCompanyEntityInfosForOfferTeaser($companyId)
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();

//         $sql = "SELECT company.post_title AS name, hi.guid AS header_illu, logo.guid AS logo
//                 FROM $db->posts AS company

//                 LEFT JOIN $db->postmeta AS pm_hi
//                     ON pm_hi.post_id = company.ID AND pm_hi.meta_key = 'identity_header_illu'
//                 LEFT JOIN $db->posts AS hi
//                     ON hi.ID = pm_hi.meta_value

//                 LEFT JOIN $db->postmeta AS pm_logo
//                     ON pm_logo.post_id = company.ID AND pm_logo.meta_key = 'identity_logo'
//                 LEFT JOIN $db->posts AS logo
//                     ON logo.ID = pm_logo.meta_value

//                 WHERE company.ID = $companyId
//         ";

//         $result = $db->get_row($sql);

//         $logoUrl = Utils::getProp('logo', $result);

//         if (!Utils::isUrl($logoUrl)) {
//             $logoUrl = Utils::getHost() . '/' . $logoUrl;
//         }

//         $companyInfos = [
//             'name' => Utils::getProp('name', $result),
//             'header_illu' => new Media(Utils::getProp('header_illu', $result)),
//             'logo'        => new Image($logoUrl)
//         ];

//         return $companyInfos;
//     }

//     /**
//      * Get all Medias Header of Premium Companies
//      *
//      * @return ArrayCollection
//      */
//     public static function getPremiumCompaniesMediasHeader()
//     {
//         $companiesIds = self::getPremiumCompaniesId();

//         $mediasUri = self::getACFImagesUriByPostsId($companiesIds, 'identity_header_illu');
//         $mediasHeader = [];

//         foreach ($mediasUri as $uri) {
//             $uri = str_replace('lamacompta.co/', '', $uri);
//             $uri = str_replace('/homepages/36/d801763025/htdocs/www/websites/prodnU3f75Hazr4/', Utils::getHost() . '/', $uri);

//             if (Utils::isUrl($uri)) {
//                 $mediasHeader[] = new Media($uri);
//             }
//         }

//         return Utils::createArrayCollection($mediasHeader);
//     }

//     /**
//      * Get URIs of images ACF $fielName for given posts IDs
//      *
//      * @param array|string $postsId
//      * @param string $fieldName
//      *
//      * @return array
//      */
//     public static function getACFImagesUriByPostsId($postsId, $fieldName)
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();

//         if (is_array($postsId)) {
//             $postsId = implode(',', $postsId);
//         }

//         $sql = "SELECT p.guid
//                 FROM $db->postmeta AS pm1
//                 INNER JOIN $db->posts AS p
//                     ON p.ID = pm1.meta_value
//                 WHERE pm1.post_id IN ($postsId) AND pm1.meta_key = '$fieldName'
//         ";

//         $images = array_map(
//             function ($obj) {
//                 return $obj->guid;
//             },
//             $db->get_results($sql)
//         );

//         return $images;
//     }

//     /**
//      * Get IDs of Premium Companies
//      *
//      * @return array
//      */
//     public static function getPremiumCompaniesId()
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();

//         $idExampleCompanyEntity = POST_ID_EXAMPLE_COMPANY_PAGE;
//         $idLamacomptaPage = POST_ID_LAMACOMPTA_PAGE;
//         $idCompanyEntityTag     = COMPANY_TAG_ID;

//         $sql = "SELECT posts.ID
//                 FROM $db->posts AS posts
//                 LEFT JOIN $db->term_relationships AS tr
//                     ON posts.ID = tr.object_id AND tr.term_taxonomy_id = $idCompanyEntityTag
//                 INNER JOIN $db->postmeta AS pm
//                     ON posts.ID = pm.post_id
//                 WHERE posts.ID NOT IN ($idExampleCompanyEntity, $idLamacomptaPage)
//                     AND ( pm.meta_key = 'premium' AND pm.meta_value = '1' )
//                     AND posts.post_type = 'post'
//                     AND posts.post_status = 'publish'
//                 GROUP BY posts.ID
//                 ORDER BY posts.post_date DESC";

//         $ids = array_map(
//             function($idObj) {
//                 return $idObj->ID;
//             },
//             $db->get_results($sql)
//         );

//         return $ids;
//     }

//     /**
//      * Get number of Departments where Lamacompta is present (= departments where our companies registered are present)
//      *
//      * @return int Number of Departments
//      */
//     public static function getNbDepartmentsWhereWeArePresent()
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();

//         $sql = "SELECT count(d.departments) as nbDepartments
//                 FROM (
//                     SELECT SUBSTR($db->postmeta.meta_value, 1, 2) AS departments
//                     FROM $db->posts
//                     LEFT JOIN $db->term_relationships
//                         ON ($db->posts.ID = $db->term_relationships.object_id)
//                     INNER JOIN $db->postmeta
//                         ON ( $db->posts.ID = $db->postmeta.post_id )
//                     WHERE ( $db->term_relationships.term_taxonomy_id = " . COMPANY_TAG_ID . ")
//                     AND (
//                         ( $db->postmeta.meta_key LIKE 'permises_addresses_%_postal_code')
//                     ) AND $db->posts.post_type = 'post'
//                     AND ($db->posts.post_status = 'publish')
//                     GROUP BY departments
//                 ) AS d;"
//         ;

//         return (int) $db->get_row($sql)->nbDepartments;
//     }

//     /**
//      * Get Companies Infos in JSON format for given Companies
//      *
//      * @param ArrayCollection $companies
//      *
//      * @return json
//      */
//     public static function getCompaniesInfosJson($companies)
//     {
//         $jsonResult = [];

//         if ($companies instanceof ArrayCollection) {
//             $companies = $companies->toArray();
//         }

//         if (is_array($companies)) {
//             foreach ($companies as $company) {
//                 if ($company instanceof CompanyEntity) {
//                     $jsonResult[] = $company->toArray();
//                 }
//             }
//         }

//         return json_encode($jsonResult);
//     }

//     /**
//      * Get Addresses Infos in JSON format for given Companies
//      *
//      * @param ArrayCollection $companies
//      *
//      * @return json
//      */
//     public static function getCompaniesInfosJsonAddresses($companies)
//     {
//         $jsonResult = [];

//         if ($companies instanceof ArrayCollection) {
//             $companies = $companies->toArray();
//         }

//         if (is_array($companies)) {
//             foreach ($companies as $company) {
//                 $addresses = json_decode($company->getAddressesInfosJson(true));

//                 if (is_array($addresses)) {
//                     foreach ($addresses as $address) {
//                         if (is_object($address)) {
//                             $address->id = $company->getId();
//                             $address->companyName = $company->getName();
//                             $address->permalink = get_permalink($company->getId());

//                             $jsonResult[] = $address;
//                         }
//                     }
//                 }
//             }
//         }

//         return json_encode($jsonResult);
//     }

//     /**
//      * Get Companies Infos in JSON format for all Companies
//      *
//      * @return json
//      */
//     public static function getAllCompaniesInfosJson()
//     {
//         return self::getCompaniesInfosJson(self::getCompanies());
//     }

//     /**
//      * Get Companies Infos in JSON format for Companies Sorted
//      *
//      * @return json
//      */
//     public static function getCompaniesSortedInfosJson()
//     {
//         return self::getCompaniesInfosJson(self::getCompaniesSorted(self::getCompanies(), MAX_COMPANIES_TO_DISPLAY));
//     }

//     /**
//      * Get Addresses Infos in JSON format for all Companies
//      *
//      * @return json
//      */
//     public static function getAllCompaniesInfosJsonAddresses()
//     {
//         return self::getCompaniesInfosJsonAddresses(self::getCompanies());
//     }

//     /**
//      * Generate JSON File with All Companies Infos
//      *
//      * @return void
//      */
//     public static function generateJsonFileCompanies()
//     {
//         $jsonPath = get_stylesheet_directory() . PATH_JSON_COMPANIES;
//         file_put_contents($jsonPath, self::getAllCompaniesInfosJson());
//     }

//     /**
//      * Generate JSON File with All Companies Infos
//      *
//      * @return void
//      */
//     public static function generateJsonFileCompaniesSorted()
//     {
//         $jsonPath = get_stylesheet_directory() . PATH_JSON_COMPANIES_SORTED;
//         file_put_contents($jsonPath, self::getCompaniesSortedInfosJson());
//     }

//     /**
//      * Generate JSON File with All Companies Addresses Infos for Map
//      *
//      * @return void
//      */
//     public static function generateJsonFileCompaniesAddresses()
//     {
//         $jsonPath = get_stylesheet_directory() . PATH_JSON_COMPANIES_ADDRESSES;
//         file_put_contents($jsonPath, self::getAllCompaniesInfosJsonAddresses());
//     }

//     /**
//      * Generate JSON Files for Companies Objects
//      *
//      * @return void
//      */
//     public static function generateJsonFilesCompaniesObjects()
//     {
//         self::generateJsonFileCompanies();
//         self::generateJsonFileCompaniesSorted();
//     }

//     /**
//      * Generate All JSON Files for Companies
//      *
//      * @return void
//      */
//     public static function generateAllJsonFilesCompanies()
//     {
//         self::generateJsonFilesCompaniesObjects();
//         self::generateJsonFileCompaniesAddresses();
//     }

//     /**
//      * Get Companies Objects from JSON File
//      *
//      * @return ArrayCollection
//      */
//     public static function getCompaniesFromJson()
//     {
//         $fileUri = get_stylesheet_directory_uri() . PATH_JSON_COMPANIES;

//         if (!Utils::isFileExistsFromUrl($fileUri)) {
//             self::generateJsonFileCompanies();
//         }

//         return CompanyEntity::getObjectsFromJson(json_decode(file_get_contents($fileUri)));
//     }

//     /**
//      * Get Companies Sorted Objects from JSON File
//      *
//      * @return ArrayCollection
//      */
//     public static function getCompaniesSortedFromJson()
//     {
//         $fileUri = get_stylesheet_directory_uri() . PATH_JSON_COMPANIES_SORTED;

//         if (!Utils::isFileExistsFromUrl($fileUri)) {
//             self::generateJsonFileCompaniesSorted();
//         }

//         return CompanyEntity::getObjectsFromJson(json_decode(file_get_contents($fileUri)));
//     }

//     /**
//      * Check if Workforce filter is valid
//      *
//      * @param array $fWorkforce Workforce filter
//      *
//      * @return bool
//      */
//     public static function isValidFilterWorkforce($fWorkforce)
//     {
//         if (!is_array($fWorkforce)) {
//             return false;
//         }

//         $isOk = true;
//         foreach ($fWorkforce as $workforce) {
//             if (!CompanyEntity::isWorkforceRange($workforce)) {
//                 $isOk = false;
//             }
//         }

//         return $isOk;
//     }

//     /**
//      * Check if Cities filter is valid
//      *
//      * @param array $fCitiesAndDept  filter
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
//      * Check if Job Types filter is valid
//      *
//      * @param array $fJobTypes Cutomer Types filter
//      *
//      * @return bool
//      */
//     public static function isValidFilterJobTypes($fJobTypes)
//     {
//         if (!is_array($fJobTypes)) {
//             return false;
//         }

//         $isOk = true;
//         foreach ($fJobTypes as $jobType) {
//             if (!CompanyEntity::isJobType($jobType)) {
//                 $isOk = false;
//             }
//         }

//         return $isOk;
//     }

//     /**
//      * Check if Badges filter is valid
//      *
//      * @param array $fBadges Badges filter
//      *
//      * @return bool
//      */
//     public static function isValidFilterBadges($fBadges)
//     {
//         if (!is_array($fBadges)) {
//             return false;
//         }

//         $isOk = true;
//         foreach ($fBadges as $value) {
//             if (!is_string($value) || !is_int((int)$value)) {
//                 $isOk = false;
//             }
//         }

//         return $isOk;
//     }
}
