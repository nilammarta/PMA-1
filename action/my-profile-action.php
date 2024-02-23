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
function saveUpdateProfile(int $id, array $dataInput, $PDO): void
{
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

    if ($_POST['newPassword'] != null){
        $password = encryptPassword($_POST['newPassword']);
    }else{
        $query = 'SELECT password FROM Persons WHERE ID = :ID';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'ID' => $id
        ));
        $password = $statement->fetch(PDO::FETCH_ASSOC)['password'];
    }

    try {
        $query = 'UPDATE Persons SET first_name = :first_name, last_name = :last_name, nik = :nik, email = :email,
                   password = :password, birth_date = :birth_date, sex = :sex, address = :address, 
                   internal_notes = :internal_notes WHERE ID = :ID';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'ID' => $id,
            'first_name' => ucfirst($dataInput['firstName']),
            'last_name' => ucfirst($dataInput['lastName']),
            'nik' => $dataInput['nik'],
            'email' => $dataInput['email'],
            'password' => $password,
            'birth_date' => convertStringIntoDate('Y-m-d', $dataInput['birthDate']),
            'sex' => $dataInput['sex'],
            'address' => $dataInput['address'],
            'internal_notes' => ucwords($dataInput['internalNotes']),
        ));
        $_SESSION['info'] = "Your profile has been updated!";
    }catch (PDOException $e ) {
            $_SESSION['error'] = 'Query error: ' . $e->getMessage();
            $_SESSION['inputData'] = $dataInput;
            header('Location: ../my-profile.php?person='. $id . '&error=1');
            die();
    }
}

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

if ($_SESSION['search'] != null && $_SESSION['filter'] != null){
    $url = "search=" . $_SESSION['search'] . "&filter=" . $_SESSION['filter'] . "&";
}else{
    $url = "";
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

    redirect('../my-profile.php', $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId']);
} else {
    unset($_SESSION['errorData']);
    unset($_SESSION['inputData']);
    unset($_SESSION['errorPassword']);

    $dataInput = inputData();
    $saved = saveUpdateProfile($_SESSION['personId'], $dataInput, $PDO);
    $_SESSION['userEmail'] = $dataInput['email'];
    $_SESSION['userName'] = ucwords($dataInput['firstName']);
    redirect('../my-profile.php', "");
}

