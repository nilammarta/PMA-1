<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/jsonHelper.php";

session_start();

function saveUpdateProfile(int $id): bool
{
    $persons = getPersonsData();
    for ($i = 0; $i <count($persons); $i++){
        if ($persons[$i]['id'] == $id){
            if ($_POST['newPassword'] != null){
                $password = encryptPassword($_POST['newPassword']);
            }else{
                $password = $persons[$i]['password'];
            }

            $persons[$i]['firstName'] = ucfirst($_POST['firstName']);
            $persons[$i]['lastName'] = ucfirst($_POST['lastName']);
            $persons[$i]['nik'] = $_POST['nik'];
            $persons[$i]['email'] = $_POST['email'];
            $persons[$i]['password'] = $password;
            $persons[$i]['birthDate'] = convertStringIntoDate("Y-m-d", $_POST['birthDate']);
            $persons[$i]['sex'] = $_POST['sex'];
            $persons[$i]['address'] = $_POST['address'];

            saveDataIntoJson($persons);
            return true;
        }
    }

    return false;
}

if ($_SESSION['search'] != null && $_SESSION['filter'] != null){
    $url = "search=" . $_SESSION['search'] . "&filter=" . $_SESSION['filter'] . "&";
}else{
    $url = "";
}

if ($_POST['currentPassword'] != null || $_POST['newPassword']) {
    $errorPass = passwordValidate($_SESSION['personId'], $_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword']);
}else{
    $errorPass = [];
}

$errorData = editValidate($_POST['nik'], $_POST['email'], $_SESSION['personId'], $_POST['birthDate']);
if (count($errorData) != 0 || count($errorPass) != 0){
    $_SESSION['errorData'] = $errorData;
    $_SESSION['inputData'] = inputData();
    $_SESSION['errorPassword'] = $errorPass;

    redirect('../myProfile.php', $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId']);
}else{
    unset($_SESSION['errorData']);
    unset($_SESSION['inputData']);
    unset($_SESSION['errorPassword']);

    $saved = saveUpdateProfile($_SESSION['personId']);

    if ($saved) {
        $_SESSION['userEmail'] = $_POST['email'];
        $_SESSION['userName'] = $_POST['firstName'];
        redirect('../myProfile.php', '&saved=1');
    }
}

