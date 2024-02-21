<?php
require_once __DIR__ . "/json-helper.php";

/**
 * @param array $persons
 * @param string $searchInput
 * @return array|null
 * function to get search result based on search input
 */
function searchPerson(array $persons, string $searchInput): array|null
{
    $search = urldecode($searchInput);
    $results = [];
    $resultsLastName = [];
    if (isset($search)) {
        foreach ($persons as $value) {
            if (preg_match("/$search/i", $value["first_name"]) == 1) {
                $results [] = $value;
            }
        }

        foreach ($persons as $value) {
            if (preg_match("/$search/i", $value["last_name"]) == 1) {
                $resultsLastName[] = $value;
            }
        }

        foreach ($resultsLastName as $result) {
            if (in_array($result, $results) == 0) {
                $results[] = $result;
            }
        }

        if (count($results) != null) {
            return $results;
        }
    }
    return null;
}

/**
 * @param string $filterValue
 * @return array|null
 * function to filtering the persons data based on string filter value
 */
function filter(string $filterValue): array|null
{
    $persons = getPersonsData();
    if ($filterValue == "productive") {
        $adult = [];
        foreach ($persons as $person) {
            if (getAge($person["birthDate"]) > 15 && getAge($person['birthDate']) <= 64) {
                $adult[] = $person;
            }
        }
        return $adult;
    } elseif ($filterValue == "elderly"){
        $elderly = [];
        foreach ($persons as $person){
            if (getAge($person['birthDate']) > 64){
                $elderly[] = $person;
            }
        }
        return $elderly;
    } elseif ($filterValue == "children") {
        $child = [];
        foreach ($persons as $person) {
            if (getAge($person["birthDate"]) <= 15) {
                $child [] = $person;
            }
        }
        return $child;
    } elseif ($filterValue == "male") {
        $male = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "m") {
                $male [] = $person;
            }
        }
        return $male;

    } elseif ($filterValue == "female") {
        $female = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "f") {
                $female [] = $person;
            }
        }
        return $female;

    } elseif ($filterValue == "passedAway") {
        $passed = [];
        foreach ($persons as $person){
            if (!$person["alive"]){
                $passed[] = $person;
            }
        }
        return $passed;

    }elseif ($filterValue == "allPersons"){
        return getPersonsData();

    } else {
        return null;
    }
}

/**
 * @param array $data
 * @param int $page
 * @param int $limit
 * @return array
 * function to get paginated data
 */
function getPaginatedData(array $data, int $page, int $limit): array
{
//   untuk mendapatkan jumlah halaman yang di perlukan dengan membagi antara banyak data dengan limit yang di tentukan
    $totalPage = ceil((float)count($data) / (float)$limit);
//   untuk mendapatkan index dari data person yang akan di mulai dari setiap halaman
    $indexStart = ($page - 1) * $limit;
    $length = $limit;
    if (($indexStart + $limit) > count($data)) {
        $length = count($data) - $indexStart;
    }

    return [
        "totalPage" => $totalPage,
        "pagingData" => array_slice($data, $indexStart, $length),
        "currentPage" => $page,
    ];
}

/**
 * @param string $filterValue
 * @return string
 * function to get filter by filter value
 */
function getFilter(string $filterValue): string
{
    if ($filterValue == "productive"){
        return "In Productive Age (15-64 y.o)";
    } elseif ($filterValue == "elderly"){
        return "Elderly ( > 64 y.o)";
    } elseif ($filterValue == "children"){
        return "Children (0-15 y.o)";
    } else if ($filterValue == "male"){
        return "Male";
    } else if ($filterValue == "female"){
        return "Female";
    }else if ($filterValue == "passedAway"){
        return "PassedAway";
    }else{
        return "All Persons Data";
    }
}

/**
 * @param string $filter
 * @return string
 * function to get filter value
 */
function getFilterValue(string $filter): string
{
    if ($filter == "productive"){
        return "productive";
    } else if ($filter == "elderly"){
        return "elderly";
    } elseif ($filter == "children"){
        return "children";
    } elseif ($filter == "male"){
        return "male";
    } elseif ($filter == "female"){
        return "female";
    } elseif ($filter == "passedAway"){
        return "passedAway";
    }else{
        return "allPersons";
    }
}