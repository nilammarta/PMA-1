<?php
require_once __DIR__ . "/../assets/jsonHelper.php";

function searchPerson(array $persons, string $searchInput): array|null
{
//    $persons = loadDataIntoJson("/../assets/json/persons.json");
    $search = urldecode($searchInput);
    $results = [];
    $resultsLastName = [];
    if (isset($search)) {
        foreach ($persons as $value) {
            if (preg_match("/$search/i", $value["firstName"]) == 1) {
                $results [] = $value;
            }
        }

        foreach ($persons as $value) {
            if (preg_match("/$search/i", $value["lastName"]) == 1) {
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

//date('j F Y', $value->getBirthDate())

// filtering persons
function filter(string $filter): array|null
{
    $persons = personsData();
    if ($filter == "adult") {
        $adult = [];
        foreach ($persons as $person) {
            if (checkAge($person["birthDate"]) > 15 && $person["alive"] == true) {
                $adult[] = $person;
            }
        }
        return $adult;
    } elseif ($filter == "child") {
        $child = [];
        foreach ($persons as $person) {
            if (checkAge($person["birthDate"]) <= 15 && $person["alive"] == true) {
                $child [] = $person;
            }
        }
        return $child;
    } elseif ($filter == "male") {
        $male = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "m") {
                $male [] = $person;
            }
        }
        return $male;

    } elseif ($filter == "female") {
        $female = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "f") {
                $female [] = $person;
            }
        }
        return $female;

    } elseif ($filter == "passedAway") {
        $passed = [];
        foreach ($persons as $person){
            if ($person["alive"] == false){
                $passed[] = $person;
            }
        }
        return $passed;

    } else {
        return null;
    }
}

// paginated data
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
