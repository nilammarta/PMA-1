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


//if (checkNik($_POST['nik']) == null){
//    redirect("../create.php", "nikError=1");
//}elseif (isNikExits($_POST['nik'])){
//    redirect("../create.php", "nikError=nikExists");
//}else if (checkPassword($_POST['password']) == null){
//    redirect("../create.php", "passError=1");
//}

//tampung error terlebih dahulu baru redirect
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
        $error [] = "emailError=1";
    }
    return $error;
}

$errorData = error($_POST['nik'], $_POST['password'], $_POST['email']);
if (count($errorData) != null){
//    foreach ($errorData as $error) {
    $params = implode("&", $errorData);
//    }

    redirect("../create.php", $params);
}


//if (checkNik($_POST['nik']) == null){
//    redirect("../create.php", "nikError=1&");
//}




//var_dump($newPerson);


function saveData()
{
    $persons = getPersonsData();
    $newPerson = [
        "id" => generateId($persons),
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "nik" => $_POST["nik"],
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

    $persons [] = $newPerson;
    saveDataIntoJson($persons);
}

