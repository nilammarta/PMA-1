<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/../assets/jsonHelper.php";

session_start();

function saveUpdateData(int $id): bool
{
    $persons = getPersonsData();
    for ($i = 0; $i < count($persons); $i++){
        if ($persons[$i]['id'] == $id) {
            if ($_POST['currentPassword'] != null){
                $password = $_POST['newPassword'];
            }else{
                $password = $persons[$i]['password'];
            }
            $persons[$i]['firstName'] = ucfirst($_POST['firstName']);
            $persons[$i]['lastName'] = ucfirst($_POST['lastName']);
            $persons[$i]['nik'] = $_POST['nik'];
            $persons[$i]['email'] = $_POST['email'];
            $persons[$i]['password'] =  $password;
            $persons[$i]['birthDate'] = convertStringIntoDate("Y-m-d", $_POST['birthDate']);
            $persons[$i]['sex'] = $_POST['sex'];
            $persons[$i]['address'] = $_POST['address'];
            $persons[$i]['internalNotes'] = $_POST['internalNotes'];
            $persons[$i]['role'] = $_POST['role'];
            $persons[$i]['alive'] = convertSwitchValue($_POST['alive']);

            saveDataIntoJson($persons);
            return true;
        }
    }
    return false;
}


if (isset($_SESSION["search"]) != null && isset($_SESSION['filter']) != null) {
    $url = "search=" . $_SESSION['search'] . "&filter=" . $_SESSION['filter'] . "&";
} else {
    $url = "";
}


function passwordValidate(string $currentPass, string $newPass, string $confirmPass): array
{
    $validation = [];

    if (isMatchCurrentPassword($_SESSION['personId'], $currentPass) == false){
        $validation['currentPass'] = "Password input is not correct, please type again!";
    }

    if (checkInputPassword($newPass) == null){
        $validation['newPass'] = "Password password is not correct, password must have at least 1 capital letter, 1 non capital letter and 1 number,
        with minimum of 8 characters and maximum 16 characters!";

    }

    if ($confirmPass != $newPass){
        $validation['newPass'] = "Password password is not correct, password must have at least 1 capital letter, 1 non capital letter and 1 number,
        with minimum of 8 characters and maximum 16 characters!";
    }


    return $validation;
}

//if ($_POST['currentPassword'] != null && $_POST['newPassword'])
$errorPass = passwordValidate($_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword']);
$errorData = editValidate($_POST['nik'], $_POST['email'], $_SESSION['personId']);
if (count($errorData) != 0 || count($errorPass) != 0){
    $_SESSION['nikError'] = $errorData['nik'];
    $_SESSION['emailError'] = $errorData['email'];
    $_SESSION['inputData'] = inputData();
    $_SESSION['currentPasswordError'] =$errorPass['currentPass'];
    $_SESSION['newPasswordError'] = $errorPass['newPass'];
//    $_SESSION['confirmPasswordError'] = $errorPass['confirmPass'];

    redirect('../edit.php', $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId']);
//    exit();
}else{
    unset($_SESSION['inputData']);
    unset($_SESSION['nikError']);
    unset($_SESSION['emailError']);
    unset($_SESSION['currentPasswordError']);
    unset($_SESSION['newPasswordError']);
//    unset($_SESSION['confirmPasswordError']);

    $saved = saveUpdateData($_SESSION['personId']);

    if($saved) {
        redirect("../view.php", $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId'] . "&saved=1");
    }
}