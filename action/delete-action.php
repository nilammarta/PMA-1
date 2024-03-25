<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../includes/pma-db.php";

global $PDO;
session_start();

if (isset($_SESSION["search"]) != null && isset($_SESSION['filter']) != null) {
    $url = "search=" . $_SESSION['search'] . "&filter=" . $_SESSION['filter'] . "&";
} else {
    $url = "";
}

$userJob = getPersonJob($_SESSION['personId'])['jobId'];

$queryPersonJob = 'DELETE FROM Persons_Jobs WHERE person_id = :personId';
$statementPersonJob = $PDO->prepare($queryPersonJob);
$statementPersonJob->execute(array(
    'personId' => $_SESSION['personId']
));

updateCountOfJobs(null, $userJob);

$queryHobby = 'DELETE FROM Hobbies WHERE person_id = :personId';
$statementHobby = $PDO->prepare($queryHobby);
$statementHobby->execute(array(
    'personId' => $_SESSION['personId']
));

$query = 'DELETE FROM Persons WHERE ID = :ID';
$statement = $PDO->prepare($query);
$statement->execute(array(
    "ID" => $_SESSION["personId"]
));


$_SESSION['deleteInfo'] = "Person data has been deleted!";
redirect("../persons.php", $url);


