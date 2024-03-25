<?php

require_once __DIR__ . "/action/common-action.php";
require_once __DIR__ . "/action/json-helper.php";
require_once "includes/pma-db.php";
global $PDO;

session_start();
checkUserLogin($_SESSION['userEmail']);

//$persons = getPersonsData();

// masukkan data 'lastLoggedIn' ke persons json
//for ($i=0; $i<count($persons); $i++){
//    if ($persons[$i]["email"] == $_SESSION['userEmail']){
//        $persons[$i]["lastLoggedIn"] = time();
//        saveDataIntoJson($persons);
//    }
//}

$query = 'UPDATE Persons SET last_logged_in = :last_logged_in WHERE email = :email';
$statement = $PDO ->prepare($query);
$statement->execute(array(
    "email" => $_SESSION['userEmail'],
    "last_logged_in" => date("Y-m-d H:i:s", time())
));

session_unset();
session_destroy();

header("Location: login.php");
exit();
