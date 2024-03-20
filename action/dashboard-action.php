<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/../includes/pma-db.php";

/**
 * @param string $filter
 * @param array $persons
 * @return int|null
 * function to get count of person based on filter person
 */
function getCountPersons(string $filter):int|null
{
    global $PDO;
//    $persons = getPersonsData();

    //    change age into timestamp
    $max = time() - (15 * (60 * 60 * 24 * 365));
    $min = time() - (64 * (60 * 60 * 24 * 365));

    if ($filter == "adult"){
//        $adult = [];
//        foreach ($persons as $person){
//            if (getAge($person["birth_date"]) > 15 && getAge($person["birth_date"]) <= 64 && $person["alive"] == 1) {
//                $adult[] = $person;
//            }
//        }

        $query = "SELECT count(*) FROM Persons WHERE birth_date >= :min AND birth_date <= :max AND alive = :alive";
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'min' => $min,
            'max' => $max,
            'alive' => 1
        ));
        return $statement->fetchColumn();

//        return count($adult);

    } elseif ($filter == "child") {
//        $child = [];
//        foreach ($persons as $person) {
//            if (getAge($person["birth_date"]) <= 15 && $person["alive"] == 1) {
//                $child [] = $person;
//            }
//        }
//        return count($child);
        $query = 'SELECT count(*) FROM Persons WHERE birth_date < :time AND alive = :alive';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'time' => $min,
            'alive' => 1
        ));
        return $statement->fetchColumn();

    } elseif ($filter == "male") {
//        $male = [];
//        foreach ($persons as $person) {
//            if ($person["sex"] == "M") {
//                $male [] = $person;
//            }
//        }
//        return count($male);
        $query = 'SELECT count(*) FROM Persons WHERE sex = :gender';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            "gender" => "M"
        ));
        return $statement->fetchColumn();

    } elseif ($filter == "female") {
//        $female = [];
//        foreach ($persons as $person) {
//            if ($person["sex"] == "F") {
//                $female [] = $person;
//            }
//        }
//        return count($female);
        $query = 'SELECT count(*) FROM Persons WHERE sex = :gender';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'gender' => "F"
        ));
        return $statement->fetchColumn();

    } elseif ($filter == "passedAway") {
//        $passed = [];
//        foreach ($persons as $person){
//            if ($person["alive"] == 0){
//                $passed[] = $person;
//            }
//        }
//        return count($passed);
        $query = 'SELECT count(*) FROM Persons WHERE alive = :alive';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'alive' => 0
        ));
        return $statement->fetchColumn();

    } else if ($filter == "allPersons"){
        $query = "SELECT count(*) FROM Persons";
        $statement = $PDO->query($query);
        $statement->execute();
        return $statement->fetchColumn();
    }else {
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