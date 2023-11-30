<?php

require_once __DIR__ . "/../assets/jsonHelper.php";



//function userLogin():array
//{
//    $data = loadDataIntoJson("/../assets/json/persons.json");
//    return check($data);
//}
function userLogin(){
    $data = loadDataIntoJson("/../assets/json/persons.json");
    for ($i=0; $i<count($data); $i++) {
        if ($_GET["id"] == $data[$i]["id"]){
            return $data[$i];
        }
    }
    return null;
}

//print_r($_GET);
//$user = userLogin($jsonData);
//print_r($user);
