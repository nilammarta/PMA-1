<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../includes/pma-db.php";

global $PDO;
session_start();

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

$errorData = editValidate($_POST['firstName'], $_POST['lastName'], $_POST['nik'], $_POST['email'], $_SESSION['personId'], $_POST['birthDate']);
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
    saveUpdateData($_SESSION['personId'], $dataInput, $PDO);
    $queryPersonJob = 'UPDATE Persons_Jobs SET job_id = :jobId WHERE person_id = :personId';
    $statementPersonJob = $PDO->prepare($queryPersonJob);
    $statementPersonJob->execute(array(
        'personId' => $_SESSION['personId'],
        'jobId' => inputData()['jobId']
    ));
    updateCountOfJobs(inputData()['jobId'], inputData()['userJob']);

    $_SESSION['info'] = "Your profile has been updated!";
    $_SESSION['userEmail'] = $dataInput['email'];
    $_SESSION['userName'] = ucwords($dataInput['firstName']);
    redirect('../my-profile.php', "");
}

