<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../includes/pma-db.php";

global $PDO;
session_start();


if (isset($_SESSION["search"]) != null && isset($_SESSION['filter']) != null) {
    $url = "search=" . $_SESSION['search'] . "&filter=" . $_SESSION['filter'] . "&";
} else {
    $url = "";
}

if (empty($_POST['newPassword']) && empty($_POST['confirmPassword'])){
    $errorPass = null;
} else {
  $errorPass = newPasswordValidate($_POST['newPassword'], $_POST['confirmPassword']);
}

$errorData = editValidate($_POST['nik'], $_POST['email'], $_SESSION['personId'], $_POST['birthDate']);
if (count($errorData) != 0 || $errorPass != null){

    $_SESSION['errorData'] = $errorData;
    $_SESSION['errorPassword'] = $errorPass;
    $_SESSION['inputData'] = inputData();

    redirect('../edit.php', $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId']);
} else {
    unset($_SESSION['errorData']);
    unset($_SESSION['inputData']);
    unset($_SESSION['errorPassword']);

    saveUpdateData($_SESSION['personId'], inputData(), $PDO, "edit");

    if (inputData()['alive'] == 0){
        $queryPersonJob = 'UPDATE Persons_Jobs SET job_id = :jobId WHERE person_id = :personId';
        $statementPersonJob = $PDO->prepare($queryPersonJob);
        $statementPersonJob->execute(array(
            'personId' => $_SESSION['personId'],
            'jobId' => 1
        ));

        //    update count of job pada database jobs
        updateCountOfJobs(1, inputData()['userJob']);
    }else {
//   update job data pada database Person_Jobs
        $queryPersonJob = 'UPDATE Persons_Jobs SET job_id = :jobId WHERE person_id = :personId';
        $statementPersonJob = $PDO->prepare($queryPersonJob);
        $statementPersonJob->execute(array(
            'personId' => $_SESSION['personId'],
            'jobId' => inputData()['jobId']
        ));
        //    update count of job pada database jobs
        updateCountOfJobs(inputData()['jobId'], inputData()['userJob']);
    }

    redirect("../view.php", $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId']);
}