<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/jsonHelper.php";

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
function validate(string $nik, string $password, string $confirmPassword, string $email, string $birthDate):array
{
    $validate = [];
    if (checkNik($nik) == null) {
        $validate['nik'] = "Please type the correct NIK, at least 16 characters and only numeric NIK is allowed!";
    }

    if (isNikExits($nik, null) == true) {
        $validate['nik'] = "NIK is already exists in database please type another NIK!";
    }

    if (newPasswordValidate($password, $confirmPassword) != ""){
        $validate['password'] = newPasswordValidate($password, $confirmPassword);
    }

    if (isEmailExists($email, null) == true) {
        $validate['email'] = "Email address is already exists in database, please type another email!";
    }

    if (checkFormatEmail($email) == null) {
        $validate['email'] = "Email format is not correct, please type again!";

    }

    $timestamp = convertStringIntoDate('Y-m-d', $birthDate);
    if (time() < $timestamp){
        $validate['birthDate'] = "Birth Date is not correct, please input again!";
    }

    return $validate;
}

// function to save new data person
function saveData():int
{
    $persons = getPersonsData();
    $newPerson = [
        "id" => generateId($persons),
        "firstName" => ucfirst($_POST['firstName']),
        "lastName" => ucfirst($_POST['lastName']),
        "nik" => $_POST["nik"],
        "email" => $_POST['email'],
        "password" => encryptPassword($_POST['password']),
        "birthDate" =>convertStringIntoDate('Y-m-d', $_POST['birthDate']),
        "sex" => $_POST['sex'],
        "address" => $_POST['address'],
        "internalNotes" => $_POST['internalNotes'],
        "role" => $_POST['role'],
        "alive" => convertSwitchValue($_POST['alive']),
        "lastLoggedIn" => null
    ];

    $persons [] = $newPerson;
    saveDataIntoJson($persons);
    return $newPerson['id'];
}

$errorData = validate($_POST['nik'], $_POST['password'], $_POST['confirmPassword'], $_POST['email'], $_POST['birthDate']);
if (count($errorData) != 0){
    $_SESSION['nikError'] = $errorData["nik"];
    $_SESSION['emailError'] = $errorData['email'];
    $_SESSION['passwordError'] = $errorData['password'];
    $_SESSION['birthDateError'] = $errorData['birthDate'];
    $_SESSION['dataInput'] = inputData();

    header("Location: ../create.php");
    exit();
}else{
    unset($_SESSION['nikError']);
    unset($_SESSION['emailError']);
    unset($_SESSION['passwordError']);
    unset($_SESSION['dataInput']);
    unset($_SESSION['birthDateError']);

    $personId = saveData();
    if ($personId != null) {
        redirect("../view.php", "page=1&person=" . $personId . "&saved=1");
    }
}
