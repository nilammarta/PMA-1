<?php

require_once __DIR__ . "/action/common-action.php";
require_once __DIR__ . "/action/json-helper.php";
require_once "includes/pma-db.php";
global $PDO;

session_start();
checkUserLogin($_SESSION['userEmail']);

$persons = getPersonsData($PDO);

// masukkan data 'lastLoggedIn' ke persons json
for ($i=0; $i<count($persons); $i++){
    if ($persons[$i]["email"] == $_SESSION['userEmail']){
        $persons[$i]["last_logged_in"] = time();
        saveDataIntoJson($persons);
    }
}

session_unset();
session_destroy();

header("Location: login.php");
exit();
