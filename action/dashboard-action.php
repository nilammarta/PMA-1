<?php

require_once __DIR__ . "/common-action.php";

/**
 * @param string $filter
 * @param array $persons
 * @return int|null
 * function to get count of person based on filter person
 */
function getCountPersons(string $filter, array $persons):int|null
{
//    $persons = getPersonsData();
    if ($filter == "adult"){
        $adult = [];
        foreach ($persons as $person){
            if (getAge($person["birth_date"]) > 15 && getAge($person["birth_date"]) <= 64 && $person["alive"] == 1) {
                $adult[] = $person;
            }
        }
        return count($adult);

    } elseif ($filter == "child") {
        $child = [];
        foreach ($persons as $person) {
            if (getAge($person["birth_date"]) <= 15 && $person["alive"] == 1) {
                $child [] = $person;
            }
        }
        return count($child);
    } elseif ($filter == "male") {
        $male = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "M") {
                $male [] = $person;
            }
        }
        return count($male);

    } elseif ($filter == "female") {
        $female = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "F") {
                $female [] = $person;
            }
        }
        return count($female);

    } elseif ($filter == "passedAway") {
        $passed = [];
        foreach ($persons as $person){
            if ($person["alive"] == 0){
                $passed[] = $person;
            }
        }
        return count($passed);

    } else {
        return null;
    }
}

/**
 * @param int|null $time
 * @return string
 * function to get last logged in (last activity) of person
 */
function lastActivity(int|null $time):string
{
    if ($time != null){
        return date('l, j F Y,  H:i A', $time);
    }else{
        return "-";
    }
}