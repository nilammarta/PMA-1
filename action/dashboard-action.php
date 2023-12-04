<?php

require_once __DIR__ . "/common-action.php";

// function for filtering person
function getCountPersons(string $filter):int|null
{
    $persons = personsData();
    if ($filter == "adult"){
        $adult = [];
        foreach ($persons as $person){
            if (checkAge($person["birthDate"]) > 15 && $person["alive"] == true) {
                $adult[] = $person;
            }
        }
        return count($adult);

    } elseif ($filter == "child") {
        $child = [];
        foreach ($persons as $person) {
            if (checkAge($person["birthDate"]) <= 15 && $person["alive"] == true) {
                $child [] = $person;
            }
        }
        return count($child);
    } elseif ($filter == "male") {
        $male = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "m") {
                $male [] = $person;
            }
        }
        return count($male);

    } elseif ($filter == "female") {
        $female = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "f") {
                $female [] = $person;
            }
        }
        return count($female);

    } elseif ($filter == "passedAway") {
        $passed = [];
        foreach ($persons as $person){
            if ($person["alive"] == false){
                $passed[] = $person;
            }
        }
        return count($passed);

    } else {
        return null;
    }
}