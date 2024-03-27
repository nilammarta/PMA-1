<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/../includes/pma-db.php";

/**
 * @param string $filter
 * @param array $persons
 * @return int|null
 * function to get count of person based on filter person
 */
function getCountPersonsByCategory(string $filter):int|null
{
    global $PDO;

    if ($filter == "productive"){

        $query = 'SELECT COUNT(*) FROM Persons WHERE YEAR(NOW()) - YEAR(birth_date) >= 17 AND YEAR(NOW()) - YEAR(birth_date) <= 65 AND alive = :alive';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'alive' => 1
        ));
        return $statement->fetchColumn();

    } elseif ($filter == "children") {
        $query = 'SELECT COUNT(*) FROM Persons WHERE YEAR(NOW()) - YEAR(birth_date) < 17 AND alive = :alive';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'alive' => 1
        ));
        return $statement->fetchColumn();

    } elseif ($filter == "male") {
        $query = 'SELECT COUNT(*) FROM Persons WHERE sex = :gender';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            "gender" => "M"
        ));
        return $statement->fetchColumn();

    } elseif ($filter == "female") {

        $query = 'SELECT COUNT(*) FROM Persons WHERE sex = :gender';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'gender' => "F"
        ));
        return $statement->fetchColumn();

    } elseif ($filter == "passedAway") {

        $query = 'SELECT COUNT(*) FROM Persons WHERE alive = :alive';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'alive' => 0
        ));
        return $statement->fetchColumn();

    } else if ($filter == "allPersons"){
        $query = "SELECT COUNT(*) FROM Persons";
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
function lastActivity(string|null $time):string
{
    $date = strtotime($time);
    if ($time != null){
        return date('l, j F Y,  H:i A', $date);
    }else{
        return "-";
    }
}