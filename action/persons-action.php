<?php
require_once __DIR__ . "/jsonHelper.php";

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

// filtering persons
function filter(string $filter): array|null
{
    $persons = getPersonsData();
    if ($filter == "productive") {
        $adult = [];
        foreach ($persons as $person) {
            if (getAge($person["birthDate"]) > 15 && getAge($person['birthDate']) <= 64) {
                $adult[] = $person;
            }
        }
        return $adult;
    } elseif ($filter == "elderly"){
        $elderly = [];
        foreach ($persons as $person){
            if (getAge($person['birthDate']) > 64){
                $elderly[] = $person;
            }
        }
        return $elderly;
    } elseif ($filter == "children") {
        $child = [];
        foreach ($persons as $person) {
            if (getAge($person["birthDate"]) <= 15) {
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
            if (!$person["alive"]){
                $passed[] = $person;
            }
        }
        return $passed;

    }elseif ($filter == "allPersons"){
        return getPersonsData();

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

function getFilter(string $filter): string
{
    if ($filter == "productive"){
        return "In Productive Age (15-64 y.o)";
    } elseif ($filter == "elderly"){
        return "Elderly ( > 64 y.o)";
    } elseif ($filter == "children"){
        return "Children (0-15 y.o)";
    } else if ($filter == "male"){
        return "Male";
    } else if ($filter == "female"){
        return "Female";
    }else if ($filter == "passedAway"){
        return "PassedAway";
    }else{
        return "All Persons Data";
    }
}

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