<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/../assets/jsonHelper.php";

session_start();

function editValidate(string $nik, string $email, string $password, int $id):array
{
    $validate = [];
    if (checkNik($nik) == null){
        $validate['nik'] = "Please type the correct NIK, at least 16 characters and numeric only";
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
    for ($i = 0; $i < count($persons); $i++){
        if ($persons[$i]['id'] == $id) {
            $persons[$i]['firstName'] = ucfirst($_POST['firstName']);
            $persons[$i]['lastName'] = ucfirst($_POST['lastName']);
            $persons[$i]['nik'] = $_POST['nik'];
            $persons[$i]['email'] = $_POST['email'];
            $persons[$i]['password'] = $_POST['password'];
            $persons[$i]['birthDate'] = convertStringIntoDate("Y-m-d", $_POST['birthDate']);
            $persons[$i]['sex'] = $_POST['sex'];
            $persons[$i]['address'] = $_POST['address'];
            $persons[$i]['internalNotes'] = $_POST['internalNotes'];
            $persons[$i]['role'] = $_POST['role'];
            $persons[$i]['alive'] = convertSwitchValue($_POST['alive']);

//            var_dump($persons);
            saveDataIntoJson($persons);
            return true;
        }
    }
    return false;
}


//saveUpdateData($_SESSION['personId']);

//echo $_POST['nik'];
//echo $_POST['firstName'];
//echo "data";

$errorData = editValidate($_POST['nik'], $_POST['email'], $_POST['password'], $_SESSION['personId']);
if (count($errorData) != 0){
    $_SESSION['nikError'] = $errorData['nik'];
    $_SESSION['emailError'] = $errorData['email'];
    $_SESSION['passwordError'] = $errorData['password'];
    $_SESSION['inputData'] = inputData();

    var_dump($_SESSION);

    header("Location: ../edit.php");
    exit();
}else{
    $saved = saveUpdateData($_SESSION['personId']);
    if($saved) {
        redirect("../edit.php", "saved=1");
    }
}