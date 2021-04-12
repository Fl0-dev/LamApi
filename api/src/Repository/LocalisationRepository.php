<?php

namespace App\Repository;

// use Doctrine\Common\Collections\ArrayCollection;
// use App\Utils\Utils;

class LocalisationRepository
{
//     /**
//      * Get France regions with all informations or informations asked in paramter.
//      *
//      * @param array $fieldsTab informations asked
//      * @return ArrayCollection Liste des régions
//      */
//     public static function getRegions($fieldsTab = ['*'])
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();

//         $fields = Utils::tabToListString($fieldsTab);

//         return Utils::createArrayCollection(
//             $db->get_results("SELECT $fields FROM lca_custom_regions ORDER BY name")
//         );
//     }

//     /**
//      * Get regions names with ids
//      *
//      * @return ArrayCollection Liste des régions
//      */
//     public static function getRegionsNames()
//     {
//         return self::getRegions(['id', 'name']);
//     }

//     /**
//      * Get City row in lca_custom_cities table by given id
//      *
//      * @param int   $id        City id lca_custom_cities
//      * @param array $fieldsTab Fields to get
//      *
//      * @return array|null
//      */
//     public static function getCityById($id, $fieldsTab = ['*'])
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();
//         $fields = Utils::tabToListString($fieldsTab);

//         $query = $db->prepare(
//             "SELECT $fields FROM {$db->prefix}custom_cities WHERE id = %d",
//             $id
//         );

//         return $db->get_row($query);
//     }

//     /**
//      * Get France cities with all informations or informations asked in parameter.
//      *
//      * @param array $fieldsTab      Fields to get
//      * @param array $searchInFields Filters Where contruct
//      * @param array $searchValues   Filters values
//      *
//      * @return ArrayCollection Cities list
//      */
//     public static function getCities($fieldsTab = ['*'], $searchInFields = null, $searchValues = null)
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();
//         $dbPrefix = $db->prefix;

//         $fields = Utils::tabToListString($fieldsTab);
//         $where  = Repository::buildWhere($searchInFields);

//         $query = $db->prepare(
//             "SELECT $fields
//              FROM {$dbPrefix}custom_cities AS c
//              INNER JOIN {$dbPrefix}custom_departments AS d
//                 ON c.department_code = d.code
//              $where
//              ORDER BY c.name",
//             $searchValues
//         );

//         return Utils::createArrayCollection($db->get_results($query));
//     }

//     /**
//      * Get France cities and departments with all informations or informations asked in parameter.
//      *
//      * @param array $fieldsTab      Fields to get (typedId, id, name, department_code)
//      * @param array $searchInFields Filters Where contruct
//      * @param array $searchValues   Filters values
//      *
//      * @return ArrayCollection Cities and Departments list : ["Nantes", "Loire-Atlantique"...]
//      */
//     public static function getCitiesAndDepartments($fieldsTab = ['*'], $searchInFields = null, $searchValues = null)
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();
//         $dbPrefix = $db->prefix;

//         $fields = Utils::tabToListString($fieldsTab);
//         $where  = Repository::buildWhere($searchInFields);

//         $query = $db->prepare(
//             "SELECT $fields
//              FROM (
//                 (SELECT CONCAT('dept-', d.id) AS typedId, d.id, d.name, d.code AS department_code
//                 FROM {$dbPrefix}custom_departments AS d
//                 GROUP BY d.name
//                 ORDER BY d.name)

//                 UNION

//                 (SELECT CONCAT('city-', c.id) AS typedId, c.id, c.name, c.department_code
//                 FROM {$dbPrefix}custom_cities AS c
//                 INNER JOIN {$dbPrefix}custom_departments AS d
//                     ON c.department_code = d.code
//                 ORDER BY c.name)
//              ) AS u
//              $where
//              GROUP BY u.name
//              ORDER BY u.name ASC
//             ",
//             $searchValues
//         );

//         return Utils::createArrayCollection($db->get_results($query));
//     }

//     /**
//      * Get cities in same departments to $cities given
//      *
//      * @param array $cities    Cities given
//      * @param array $fieldsTab Fields to get
//      *
//      * @return array Cities list
//      */
//     public static function getOtherCitiesInSameDepartments($cities, $fieldsTab = ['id'])
//     {
//         $repo = new Repository();
//         $db = $repo->getDb();

//         $tableCity = $db->prefix . 'custom_cities';
//         $citiesWhere = implode(',', $cities);

//         $fields = Utils::tabToListString($fieldsTab);

//         $query = $db->prepare(
//             "SELECT $fields
//              FROM $tableCity AS c
//              WHERE c.department_code IN (
//                 SELECT department_code
//                 FROM $tableCity
//                 WHERE id IN ($citiesWhere)
//              )
//              AND c.id NOT IN ($citiesWhere)
//              ORDER BY c.name",
//             $cities
//         );

//         $results = $db->get_results($query);

//         if (is_array($results) && count($results) > 0) {
//             $results = array_map(
//                 function ($item) {
//                     return Utils::getProp('id', $item);
//                 },
//                 $results
//             );
//         }

//         return $results;
//     }

//     /**
//      * Get cities names with ids
//      *
//      * @return ArrayCollection Cities list
//      */
//     public static function getCitiesNames()
//     {
//         return self::getCities(['c.id', 'c.name']);
//     }

//     /**
//      * Get cities names with ids
//      *
//      * @param string $keywords Keywords used to search
//      *
//      * @return ArrayCollection Cities list
//      */
//     public static function getCitiesByName($keywords)
//     {
//         return self::getCities(
//             ['c.id', 'c.name', 'c.department_code'],
//             [['field' => 'c.name', 'operator' => 'LIKE', 'type' => '%s']],
//             ["%$keywords%"]
//         );
//     }

//     /**
//      * Get cities from given departments
//      *
//      * @param array $deptsIds Departments IDs
//      *
//      * @return ArrayCollection Cities list
//      */
//     public static function getCitiesByDepartments($deptsIds)
//     {
//         $types = Repository::getInTypes($deptsIds);

//         return self::getCities(
//             ['c.id', 'c.name'],
//             [['field' => 'd.id', 'operator' => 'IN', 'type' => $types]],
//             $deptsIds
//         );
//     }

//     /**
//      * Get cities names with ids
//      *
//      * @param string $keywords Keywords used to search
//      *
//      * @return ArrayCollection Cities list
//      */
//     public static function getCitiesByNameOrDepartmentCode($keywords)
//     {
//         $searchInFields = [];
//         $name = filter_var($keywords, FILTER_SANITIZE_STRING);
//         $departmentCode = filter_var($keywords, FILTER_SANITIZE_NUMBER_INT);

//         if (strlen($name) > 1) {
//             $searchInFields[] = ['field' => 'name', 'operator' => 'LIKE', 'type' => '%s'];
//             $searchValues[] = "%$name%";
//         }

//         // If only department code given
//         if (strlen($departmentCode) > 1) {
//             $searchInFields[] = ['field' => 'department_code', 'operator' => '=', 'type' => '%s', 'logical' => 'OR'];
//             $searchValues[] = $departmentCode;
//         }

//         return self::getCitiesAndDepartments(
//             ['typedId', 'name', 'department_code'],
//             $searchInFields,
//             $searchValues
//         );
//     }

//     /**
//      * Get single City from its name
//      *
//      * @param string $cityName
//      *
//      * @return string|null
//      */
//     public static function getSingleCityFromName($cityName)
//     {
//         $city = self::getCities(
//             ['c.id', 'c.name'],
//             [['field' => 'c.name', 'operator' => '=', 'type' => '%s']],
//             [$cityName]
//         );

//         if ($city->count() === 1) {
//             return $city->first();
//         }

//         return null;
//     }
}
