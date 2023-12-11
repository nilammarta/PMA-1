<?php

session_start();
if (!isset($_SESSION['userEmail'])) {
    header("Location: login.php");
    exit();
}
require_once __DIR__ . "/action/common-action.php";
require_once __DIR__ . "/assets/jsonHelper.php";

$persons = GetPersonsData();

// masukkan data 'lastLoggedIn' ke persons json
for ($i=0; $i<count($persons); $i++){
    if ($persons[$i]["email"] == $_SESSION['userEmail']){
        $persons[$i]["lastLoggedIn"] = time();
        saveDataIntoJson($persons);
    }
}


session_unset();
session_destroy();

header("Location: login.php");
exit();
