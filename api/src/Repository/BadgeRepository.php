<?php

namespace App\Repository;

// // use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use App\Entity\Badge;
// use Doctrine\Common\Collections\ArrayCollection;
// use App\Utils\Utils;

// // class BadgeRepository extends ServiceEntityRepository
class BadgeRepository
{
//     /**
//      * Get the given WP_Post Badge as a Badge entity object
//      *
//      * @param mixed $badgeWP WP_Post or WP_Post ID
//      *
//      * @return Badge|null
//      */
//     static public function getBadge($badgeWP)
//     {
//     //     if (is_int($badgeWP)) {
//     //         $badgeWP = get_post($badgeWP);
//     //     }

//     //     $badge = null;

//     //     if (Utils::isWPPost($badgeWP)) {
//     //         $badge   = new Badge();
//     //         $badge->setObjectFromPost($badgeWP);
//     //     }

//     //     return $badge;
//     }

//     /**
//      * Get all existing badges
//      *
//      * @return ArrayCollection Badges list
//      */
//     static public function getBadges()
//     {
//         // $args = array(
//         //     'posts_per_page' => -1,
//         //     'category_name'  => 'badge',
//         //     'orderby'        => ['post_title' => 'ASC']
//         // );

//         // $badgesWP = get_posts($args);
//         // $badges   = new ArrayCollection();

//         // foreach ($badgesWP as $badgeWP) {
//         //     $badge = new Badge();
//         //     $badge->setObjectFromPost($badgeWP);

//         //     $badges->add($badge);
//         // }

//         // return $badges;
//     }

//     /**
//      * Get Badge Object from Badge Name
//      *
//      * @param string $badgeName
//      *
//      * @return Badge|null
//      */
//     public static function getBadgeFromName($badgeName)
//     {
//         // if (is_string($badgeName) && strlen($badgeName) > 0) {
//         //     $args = array(
//         //         'posts_per_page' => -1,
//         //         'post_status'    => 'publish',
//         //         'category_name'  => BADGE_TAG_SLUG,
//         //         'search_post_title' => $badgeName
//         //     );

//         //     add_filter('posts_where', ['App\Repository\Repository', 'setWPPostTitleFilter'], 10, 2);
//         //     $query = new \WP_Query($args);
//         //     remove_filter('posts_where', ['App\Repository\Repository', 'setWPPostTitleFilter'], 10);

//         //     if (is_array($query->posts) && count($query->posts) > 0) {
//         //         return self::getBadge($query->posts[0]);
//         //     }
//         // }

//         // return null;
//     }

//     /**
//      * Get array of Badges Objects for a given company
//      *
//      * @param int|WP_Post $company ID or WP_Post CompanyEntity
//      *
//      * @return array|null Array of CompanyEntity Badges
//      */
//     static public function getBadgesCompanyEntity($company)
//     {
//         // if (is_int($company)) {
//         //     $company = get_post($company);
//         // }

//         // if (Utils::isWPPost($company)) {
//         //     $activity = get_field('activity', $company);

//         //     if (is_array($activity) && array_key_exists('badges', $activity)) {
//         //         $badges = new ArrayCollection();

//         //         foreach ($activity['badges'] as $badge) {
//         //             $badge = new Badge();
//         //             $badge->setObjectFromPost($badge);

//         //             $badges->add($badge);
//         //         }

//         //         return $badges;
//         //     }
//         // }

//         return null;
//     }

//     static public function getNumberBadgesCompanyEntity($company)
//     {
//         $badges = self::getBadgesCompanyEntity($company);

//         return (is_array($badges) ? count($badges) : 0);
//     }
}
