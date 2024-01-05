<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/jsonHelper.php";

session_start();

function saveUpdateData(int $id): bool
{
    $persons = getPersonsData();
    for ($i = 0; $i < count($persons); $i++){
        if ($persons[$i]['id'] == $id) {
            if ($_POST['currentPassword'] != null){
                $password = encryptPassword($_POST['newPassword']);
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
            $persons[$i]['role'] = $_POST['role'];
            $persons[$i]['address'] = $_POST['address'];
            $persons[$i]['internalNotes'] = $_POST['internalNotes'];
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

if ($_POST['currentPassword'] != null || $_POST['newPassword'] != null) {
    $errorPass = passwordValidate($_SESSION['personId'], $_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword']);
}else{
    $errorPass = [];
}

$errorData = editValidate($_POST['nik'], $_POST['email'], $_SESSION['personId'], $_POST['birthDate']);
if (count($errorData) != 0 || count($errorPass) != 0){

    $_SESSION['errorData'] = $errorData;
    $_SESSION['errorPassword'] = $errorPass;
    $_SESSION['inputData'] = inputData();

    redirect('../edit.php', $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId']);
//    exit();
}else{
    unset($_SESSION['errorData']);
    unset($_SESSION['errorPassword']);
    unset($_SESSION['currentPasswordError']);

    $saved = saveUpdateData($_SESSION['personId']);

    if($saved) {
        redirect("../view.php", $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId'] . "&saved=2");
    }

}