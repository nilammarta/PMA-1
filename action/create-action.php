<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/json-helper.php";

session_start();

/**
 * @param $persons
 * @return int
 * function to generated id of person
 */
function generateId($persons): int
{
    if ($persons == null){
        $id = 1;
    }else{
        $lastPerson = $persons[count($persons) - 1];
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
 *tampung error yang terjadi pada inputan form
 *
 * @param $nik
 * @param $password
 * @param $email
 * @return array
 */
function validate(string $nik, string $password, string $confirmPassword, string $email, string $birthDate):array
{
    $validate = [];
    if (checkNik($nik) == null) {
        $validate['nik'] = "Please type the correct NIK, at least 16 characters and only numeric NIK is allowed!";
    }

    if (isNikExits($nik, null) == true) {
        $validate['nik'] = "NIK is already exists in database!";
    }

    if (newPasswordValidate($password, $confirmPassword) != null){
        $validate['password'] = newPasswordValidate($password, $confirmPassword);
    }

    if (isEmailExists($email, null) == true) {
        $validate['email'] = "Email address is already exists in database!";
    }

    if (checkFormatEmail($email) == null) {
        $validate['email'] = "Email format is not correct!";
    }

    $timestamp = convertStringIntoDate('Y-m-d', $birthDate);
    if (time() < $timestamp || $timestamp == null){
        $validate['birthDate'] = "Birth Date is not correct!";
    }

    return $validate;
}

/**
 * @return int => of personID
 * function to save new person data
 */
function saveData():int
{
    $persons = getPersonsData();
    $newPerson = [
        "id" => generateId($persons),
        "firstName" => ucfirst(htmlspecialchars($_POST['firstName'])),
        "lastName" => ucfirst(htmlspecialchars($_POST['lastName'])),
        "nik" => $_POST["nik"],
        "email" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
        "password" => encryptPassword($_POST['password']),
        "birthDate" =>convertStringIntoDate('Y-m-d', $_POST['birthDate']),
        "sex" => $_POST['sex'],
        "address" => htmlspecialchars($_POST['address']),
        "internalNotes" => htmlspecialchars($_POST['internalNotes']),
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

    $_SESSION['errorData'] = $errorData;
    $_SESSION['dataInput'] = inputData();
    $_SESSION['birthDate'] = $_POST['birthDate'];

    header("Location: ../create.php");
    exit();
}else{
    unset($_SESSION['errorData']);
    unset($_SESSION['dataInput']);

    $personId = saveData();
    if ($personId != null) {
        redirect("../view.php", "page=1&person=" . $personId . "&saved=1");
    }
}
