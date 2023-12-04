<?php
require_once __DIR__ . "/../assets/jsonHelper.php";

function searchPerson(array $persons): array|null
{
//    $persons = loadDataIntoJson("/../assets/json/persons.json");
    $search = $_GET['search'];
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

