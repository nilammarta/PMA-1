<?php
require_once __DIR__ . "/../assets/jsonHelper.php";

function personsData(): array
{
    return loadDataIntoJson("/../assets/json/persons.json");
}

function searchPerson(): array|null
{
    $persons = loadDataIntoJson("/../assets/json/persons.json");
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

//date convert
function convertStringIntoDate(string $format, string $birthDate): int|null
{
    $dateFormat = date_create_from_format($format, $birthDate);
    if ($dateFormat) {
        $timeStamp = date_format($dateFormat, 'U');
        return ($timeStamp);
    } else {
        return null;
    }
}

//function adult()
//{
//    $persons = personsData();
//
//    $adult = [];
//    foreach ($persons as $person) {
//        if (checkAge($person["birthDate"]) > 15) {
//            $adult[] = $person;
//        }
//    }
//    return $adult;
//
//}

// older person
function filter(string $filter): array|null
{
    $persons = personsData();
    if ($filter == "adult") {
        $adult = [];
        foreach ($persons as $person) {
            if (checkAge($person["birthDate"]) > 15) {
                $adult[] = $person;
            }
        }
        return $adult;
    } elseif ($filter == "child") {
        $child = [];
        foreach ($persons as $person) {
            if (checkAge($person["birthDate"]) <= 15) {
                $child [] = $person;
            }
        }
        return $child;
    } elseif ($filter == "male") {
        $male = [];
        foreach ($persons as $person) {
            if ($persons["sex"] == "m") {
                $male [] = $person;
            }
        }
        return $male;
    } elseif ($filter == "fimale") {
        $female = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "f") {
                $female [] = $person;
            }
            return $female;
        }
    } else {
        return null;
    }
    return null;
}

function checkAge(int $date): int
{
    $total = time() - $date;
    return floor($total / (60 * 60 * 24 * 365));

}

//$persons = personsData();
//echo checkAge($persons[4]["birthDate"]);
//var_dump(adult());