<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../includes/pma-db.php";

global $PDO;
session_start();

/**
 * @param int $id
 * @return bool
 * function to save update profile into json file
 */
//function saveUpdateProfile(int $id, array $dataInput, $PDO): void
//{
//    $persons = getPersonsData();
//    for ($i = 0; $i <count($persons); $i++){
//        if ($persons[$i]['id'] == $id){
//            if ($_POST['newPassword'] != null){
//                $password = encryptPassword($_POST['newPassword']);
//            }else{
//                $password = $persons[$i]['password'];
//            }
//            $persons[$i]['firstName'] = ucfirst($dataInput['firstName']);
//            $persons[$i]['lastName'] = ucfirst($dataInput['lastName']);
//            $persons[$i]['nik'] = $dataInput['nik'];
//            $persons[$i]['email'] = $dataInput['email'];
//            $persons[$i]['password'] = $password;
//            $persons[$i]['birthDate'] = convertStringIntoDate("Y-m-d", $dataInput['birthDate']);
//            $persons[$i]['sex'] = $dataInput['sex'];
//            $persons[$i]['address'] = $dataInput['address'];
//            if (isset($_POST['internalNotes'])) {
//                $persons[$i]['internalNotes'] = ucfirst($dataInput['internalNotes']);
//            }
//            saveDataIntoJson($persons);
//            return true;
//        }
//    }

//    return false;
//}

/**
 * @param int $id
 * @param string $currentPassword
 * @param string $newPassword
 * @param string $confirmPassword
 * @return array
 * function to validate password input and get the error message if password is error
 */
function passwordValidate(int $id, string $currentPassword, string $newPassword, string $confirmPassword):array
{
    $validate = [];
    if ($currentPassword != null){
        if (!isMatchCurrentPassword($id, $currentPassword)){
            $validate['currentPass'] = "Password input is not correct!";
        }else{
            if (empty($newPassword)){
                $validate['newPass'] = "Please type the New Password!";
            }

            if (empty($confirmPassword)){
                $validate['confirmPass'] = "Please type the Confirm Password!";
            }

            $errorNewPass = newPasswordValidate($newPassword, $confirmPassword);
            if ($errorNewPass != null) {
                $validate['passError'] = $errorNewPass;
            }
        }
    }else{
        $validate['currentPass'] = "Please input the current password first!";
    }

    return $validate;
}

if (empty($_POST['currentPassword']) && empty($_POST['newPassword']) && empty($_POST['confirmPassword'])){
    $errorPass = [];
} else{
    $errorPass = passwordValidate($_SESSION['personId'], $_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword']);
}

$errorData = editValidate($_POST['nik'], $_POST['email'], $_SESSION['personId'], $_POST['birthDate']);
if (count($errorData) != 0 || count($errorPass) != 0){
    $_SESSION['errorData'] = $errorData;
    $_SESSION['inputData'] = inputData();
    $_SESSION['errorPassword'] = $errorPass;

    redirect('../my-profile.php', "person=" . $_SESSION['personId']);
} else {
    unset($_SESSION['errorData']);
    unset($_SESSION['inputData']);
    unset($_SESSION['errorPassword']);

    $dataInput = inputData();
//    $saved = saveUpdateProfile($_SESSION['personId'], $dataInput, $PDO);
    saveUpdateData($_SESSION['personId'], $dataInput, $PDO);
    $_SESSION['userEmail'] = $dataInput['email'];
    $_SESSION['userName'] = ucwords($dataInput['firstName']);
    redirect('../my-profile.php', "");
}

