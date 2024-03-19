<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../includes/pma-db.php";

global $PDO;
session_start();

/**
 * @param array $persons
 * @return int
 * function to get count of person that have role ADMIN in json file (database)
 */
function getCountAdmin(array $persons): int
{
    $admin = [];
    foreach ($persons as $person){
        if ($person['role'] == "ADMIN"){
            $admin [] = $person;
        }
    }
    return count($admin);
}

$persons = getPersonsData();
$admin = getCountAdmin($persons);
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

//for ($i = 0; $i < count($persons); $i++) {
//    if ($persons[$i]['ID'] == $_SESSION['personId']) {
////        validasi ketika email user login sama dengan dengan email yang akan di hapus
//        if ($persons[$i]['email'] == $_SESSION['userEmail']) {
//            redirect("../view.php", $url . "page="  .$_SESSION['page'] . "&person=" . $_SESSION['personId'] . "&error=2");
//        }else{
////            unset($persons[$i]);
////            $persons = array_values($persons);
////            saveDataIntoJson($persons);
////            unset($_SESSION['personId']);
//            $query = 'DELETE FROM Persons WHERE ID = :ID';
//            $statement = $PDO->prepare($query);
//            $statement->execute(array(
//                "ID" => $_SESSION["personId"]
//            ));
//            $_SESSION['deleteInfo'] = "Person data has been deleted!";
//            redirect("../persons.php", "");
//        }
//    }
//}

