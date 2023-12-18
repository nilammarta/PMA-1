<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/../assets/jsonHelper.php";

session_start();

var_dump($_SESSION['personEdit']);
var_dump($_POST);


function editValidate(string $nik, string $email, string $password, int $id):array
{
    $validate = [];
    if (checkNik($nik) == null){
        $validate['nik'] = "Please  type the correct NIK, at least 16 characters and numeric only";
    }

    if (isNikExits($nik, $id) == true){
        $validate['nik'] = "NIK is already exists in database, please type another NIK";
    }

    if (checkFormatEmail($email) == null){
        $validate['email'] = "Email format is not correct, please type again";
    }

    if (isEmailExists($email, $id) == true){
        $validate['email'] = "Email is already exists in database, please type another email";
    }

    if (checkPassword($password) == null){
        $validate['password'] = "Password must have a minimum of 8 character and maximum 16 characters";
    }

    return $validate;
}

function saveUpdateData(int $id): bool
{
    $persons = getPersonsData();
    foreach ($persons as $person) {
        if ($person['id'] == $id) {
            $person['firstName'] = ucfirst($_POST['firstName']);
            $person['lastName'] = ucfirst($_POST['lastName']);
            $person['nik'] = $_POST['nik'];
            $person['email'] = $_POST['email'];
            $person['password'] = $_POST['password'];
            $person['birthDate'] = convertStringIntoDate("Y-m-d", $_POST['birthDate']);
            $person['sex'] = $_POST['sex'];
            $person['address'] = $_POST['address'];
            $person['internalNotes'] = $_POST['internalNotes'];
            $person['role'] = $_POST['role'];
            $person['alive'] = convertSwitchValue($_POST['alive']);
            saveDataIntoJson($persons);
            return true;
        }
    }
    return false;
}

//echo $_POST['nik'];
//echo $_POST['firstName'];
//echo "data";

$errorData = editValidate($_POST['nik'], $_POST['password'], $_POST['email'], $_SESSION['personEdit']['id']);
if (count($errorData) != 0){
    $_SESSION['nik'] = $errorData['nik'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];

    header("Location: ../edit.php");
    exit();
}else{
    $saved = saveUpdateData($_SESSION['personEdit']['id']);
    if($saved) {
        redirect("../edit.php", "saved=1");
    }
}