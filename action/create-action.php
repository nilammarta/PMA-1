<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/../assets/jsonHelper.php";

session_start();

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
function isEmailExists($newEmail): bool
{
    $persons = getPersonsData();
    foreach ($persons as $person){
        if ($person['email'] == $newEmail){
//            echo "Email is already exists in database, please input another email";
            return true;
        }
    }
    return false;
}

function checkFormatEmail($newEmail):string | null
{
    if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $newEmail)){
        return $newEmail;
    }else{
        return null;
    }

}

function convertSwitchValue($value):bool
{
    if ($value == "on"){
        return true;
    }else{
        return false;
    }
}

/**
 * ['nik'] => [
 *   'max' => 'Panjang karakter tidak boleh lebih dari x',
 *   'duplicate' => 'NIK sudah ada'
 * ],
 * ['email'] => [
 *   'format' => 'Format tidak sesuai'
 * ]
 *
 *
 * @param $nik
 * @param $password
 * @param $email
 * @return array
 */

//tampung error yang terjadi pada inputan form
function validate($nik, $password, $email):array
{
    $validate = [];
    if (checkNik($nik) == null) {
        $validate['nik'] = "Please type the correct NIK, at least 16 characters and only numeric NIK is allowed";

    }

    if (isNikExits($nik) == true) {
        $validate['nik'] = "NIK is already exists in database please type another NIK";
    }

    if (checkPassword($password) == null) {
        $validate['password'] = "Password must have a minimum of 8 characters and maximum 16 characters";
    }

    if (isEmailExists($email) == true) {
        $validate['email'] = "Email address is already exists in database, please type another email";
    }

    if (checkFormatEmail($email) == null) {
        $validate['email'] = "Email format is not correct, please type again";

    }

    return $validate;
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

function inputData ():array
{
    return [
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "nik" => $_POST['nik'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "birthDate" => $_POST['birthDate'],
        "sex" => $_POST['sex'],
        "address" => $_POST['address'],
        "internalNotes" => $_POST['internalNotes'],
        "role" => $_POST['role'],
        "alive" => $_POST['value']
    ];
}


// tutup session sebelum redirect
$errorData = validate($_POST['nik'], $_POST['password'], $_POST['email']);
if (count($errorData) != null){
    $_SESSION['nik'] = $errorData["nik"];
//    $_SESSION['nikExists'] = $errorData['nik']['duplicate'];
    $_SESSION['email'] = $errorData['email'];
//    $_SESSION['emailExists'] = $errorData['email']['duplicate'];
    $_SESSION['password'] = $errorData['password'];
    $_SESSION['dataInput'] = inputData();

    header("Location: ../create.php");
    exit();
}else{
    if (saveData()) {
        redirect("../create.php", "saved");
    }
}
