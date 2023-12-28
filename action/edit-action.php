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

$errorPass= passwordValidate($_SESSION['personId'], $_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword']);
$errorData = editValidate($_POST['nik'], $_POST['email'], $_SESSION['personId']);
if (count($errorData) != 0 || count($errorPass) != 0){
    $_SESSION['nikError'] = $errorData['nik'];
    $_SESSION['emailError'] = $errorData['email'];
    $_SESSION['inputData'] = inputData();
    $_SESSION['currentPasswordError'] = $errorPass['currentPass'];
    $_SESSION['newPasswordError'] = $errorPass['newPass'];

//    $_SESSION['confirmPasswordError'] = $errorPass['confirmPass'];
//    echo $_POST['newPassword'] . "dan" . $_POST['confirmPassword'];
//
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