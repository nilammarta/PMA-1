<?php
require_once __DIR__ . "/../assets/jsonHelper.php";

function personsData(): array
{
    return loadDataIntoJson("/../assets/json/persons.json");
}

function searchPerson():array|null
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


