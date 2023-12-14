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

function isNikExits(string $nik):bool
{
    $personsData = getPersonsData();
    foreach ($personsData as $person){
        if($person['nik'] == $nik){
            return true;
        }
    }
    return false;
}

// validate NIK
function checkNik (string $nik):string|null
{
    if (strlen($nik) == 16 && preg_match("/^[0-9]*$/", $nik)){
       return $nik;
    } else {
        return null;
    }
}


// Validate Password
function checkPassword($newPassword):string|null
{
    if (strlen($newPassword) > 16 || strlen($newPassword) < 8){
//        echo "Password must have min 8 characters and max 16 characters";
        return null;
    }else{
        return $newPassword;
    }
}

// validate Email
function isEmailExists($newEmail): string|null
{
    $persons = getPersonsData();
    foreach ($persons as $person){
        if ($person['email'] == $newEmail){
//            echo "Email is already exists in database, please input another email";
            return null;
        }
    }
    return $newEmail;
}

function checkFormatEmail($newEmail):string | null
{
    if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $newEmail)){
        return $newEmail;
    }else{
        return null;
    }

}


//tampung error yang terjadi pada inputan form
function error($nik, $password, $email):array
{
    $error = [];
    if (checkNik($nik) == null){
        $error [] = "nikError=1";
    }

    if (isNikExits($nik) == true){
        $error [] = "nikError=nikExists";
    }

    if (checkPassword($password) == null){
        $error [] = "passError=1";
    }

    if (isEmailExists($email) == null){
        $error [] = "emailError=emailExists";
    }

    if (checkFormatEmail($email) == null){
        $error [] = "emailError=1";
    }
    return $error;
}

function convertSwitchValue($value):bool
{
    if ($value == "on"){
        return true;
    }else{
        return false;
    }
}

function getInputData():array
{
   $input = [];
   $input [] = "first=". $_POST['firstName'];
   $input [] = "last=" . $_POST['lastName'];
   $input [] = "nik=" . $_POST['nik'];
   $input [] = "email=" . $_POST['email'];
   $input [] = "birthDate=" . $_POST['birthDate'];
   $input [] = "sex=" . $_POST['sex'];
   $input [] = "address=" . $_POST['address'];
   $input [] = 'notes=' . $_POST['internalNotes'];
   $input [] = 'alive=' . $_POST['alive'];


    return $input;
}

// function to save new data person
function saveData():bool
{
    $persons = getPersonsData();
    $newPerson = [
        "id" => generateId($persons),
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "nik" => $_POST["nik"],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "birthDate" =>convertStringIntoDate('Y-m-d', $_POST['birthDate']),
        "sex" => $_POST['sex'],
        "address" => $_POST['address'],
        "internalNotes" => $_POST['internalNotes'],
        "role" => $_POST['role'],
        "alive" => convertSwitchValue($_POST['value']),
        "lastLoggedIn" => null
    ];

    $persons [] = $newPerson;
    saveDataIntoJson($persons);
    return true;
}

$errorData = error($_POST['nik'], $_POST['password'], $_POST['email']);
if (count($errorData) != null){
    $params = implode("&", $errorData);
    $inputData = implode("&", getInputData());
    redirect("../create.php", $params . "&" . $inputData);
}else{
    if (saveData()) {
        redirect("../create.php", "saved");
    }
}
