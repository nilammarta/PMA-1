<?php

require_once __DIR__ . "/../assets/jsonHelper.php";

$jsonData = loadDataIntoJson("/../assets/json/persons.json");

function userLogin($data){
    for ($i=0; $i<count($data); $i++) {
        if ($_GET[0] == $data[$i]["id"]){
            return $data[$i];
        }
    }
    return [];
}

//$user = userLogin($jsonData);

