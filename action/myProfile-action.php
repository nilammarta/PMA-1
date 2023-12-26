<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/../assets/jsonHelper.php";

session_start();

function saveUpdateProfile(int $id): bool
{
    $persons = getPersonsData();
    for ($i = 0; $i <count($persons); $i++){
        if ($persons[$i]['id'] == $id){
            $persons[$i]['firstName'] = ucfirst($_POST['firstName']);
            $persons[$i]['lastName'] = ucfirst($_POST['lastName']);
            $persons[$i]['nik'] = $_POST['nik'];
            $persons[$i]['email'] = $_POST['email'];
            $persons[$i]['password'] = $_POST['password'];
            $persons[$i]['birthDate'] = convertStringIntoDate("Y-m-d", $_POST['birthDate']);
            $persons[$i]['sex'] = $_POST['sex'];
            $persons[$i]['address'] = $_POST['address'];
            $persons[$i]['internalNotes'] = $_POST['internalNotes'];

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

$errorData = editValidate($_POST['nik'], $_POST['email'], $_POST['password'], $_SESSION['personId']);
if (count($errorData) != 0){
    $_SESSION['nikError'] = $errorData['nik'];
    $_SESSION['emailError'] = $errorData['email'];
    $_SESSION['passwordError'] = $errorData['password'];
    $_SESSION['inputData'] = inputData();
    redirect('../myProfile.php', $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId']);
}else{
    unset($_SESSION['nikError']);
    unset($_SESSION['emailError']);
    unset($_SESSION['passwordError']);

    $saved = saveUpdateProfile($_SESSION['personId']);

    if ($saved) {
        $_SESSION['userEmail'] = $_POST['email'];
        $_SESSION['userName'] = $_POST['firstName'];
        redirect('../view.php', $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId'] . '&saved=1');
    }
}

