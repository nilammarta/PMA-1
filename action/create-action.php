<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/../assets/jsonHelper.php";



function generateId($persons): int
{
    if ($persons == null){
        $id = 1;
    }else{
        $lastPerson = $persons[count($persons) -1];
        $id = $lastPerson["id"] + 1;
    }
    return $id;
}

function checkNik (array $personsData, string $nik):string
{
    if (strlen($nik) != 16) {
       redirect("../create.php", "nikError=1");
    }else {
        foreach ($personsData as $person) {
            if ($person["nik"] == $nik){
                redirect("../create.php", "nikError=nikExists");
            }
        }
        return $nik;
    }
    return "";
}

function checkPassword($newPassword)
{
    if (strlen($newPassword) >16 && strlen($newPassword) < 8){
        redirect("../create.php", "passError=1");
    }else{
        redirect("../create.php", "passError=");
    }
}

$persons = getPersonsData();
$newPerson = [
    "id" => generateId($persons),
    "firstName" => $_POST['firstName'],
    "lastName" => $_POST['lastName'],
    "nik" => checkNik($persons, $_POST["nik"]),
    "email" => $_POST['email'],
    "password" => $_POST['password'],
    "birthDate" =>$_POST['birthDate'],
    "sex" => $_POST['sex'],
    "address" => $_POST['address'],
    "internalNotes" => $_POST['internalNotes'],
    "role" => $_POST['role'],
    "alive" => $_POST['alive'],
    "lastLoggedIn" => null
];

var_dump($newPerson);

//$persons [] = $newPerson;
//saveDataIntoJson($persons);

