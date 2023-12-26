<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/../assets/jsonHelper.php";

session_start();

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

$errorData = editValidate($_POST['nik'], $_POST['email'], $_POST['password'], $_SESSION['personId']);
if (count($errorData) != 0){
    $_SESSION['nikError'] = $errorData['nik'];
    $_SESSION['emailError'] = $errorData['email'];
    $_SESSION['passwordError'] = $errorData['password'];
    $_SESSION['inputData'] = inputData();

//    header("Location: ../edit.php?person=" . $_SESSION['personId'] . "&error=1");
    redirect('../edit.php', $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId']);
//    exit();
}else{
    unset($_SESSION['inputData']);
    unset($_SESSION['nikError']);
    unset($_SESSION['emailError']);
    unset($_SESSION['passwordError']);

    $saved = saveUpdateData($_SESSION['personId']);

    if($saved) {
        redirect("../view.php", $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId'] . "&saved=1");
    }
}