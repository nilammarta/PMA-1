<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../includes/pma-db.php";

global $PDO;
session_start();

/**
 * @param int $id
 * @return bool
 * function to save update data person into json file
 */
function saveUpdateData(int $id, array $dataInput, $PDO): void
{

//    $persons = getPersonsData();
//    for ($i = 0; $i < count($persons); $i++){
//        if ($persons[$i]['id'] == $id) {
//            if ($_POST['newPassword'] != null){
//                $password = encryptPassword($_POST['newPassword']);
//            } else {
//                $password = $persons[$i]['password'];
//            }
//
//            $persons[$i]['firstName'] = ucfirst($dataInput['firstName']);
//            $persons[$i]['lastName'] = ucfirst($dataInput['lastName']);
//            $persons[$i]['nik'] = $dataInput['nik'];
//            $persons[$i]['email'] = $dataInput['email'];
//            $persons[$i]['password'] = $password;
//            $persons[$i]['birthDate'] = convertStringIntoDate("Y-m-d", $dataInput['birthDate']);
//            $persons[$i]['sex'] = $dataInput['sex'];
//            $persons[$i]['role'] = $dataInput['role'];
//            $persons[$i]['address'] = $dataInput['address'];
//            $persons[$i]['internalNotes'] = ucfirst($dataInput['internalNotes']);
//            $persons[$i]['alive'] = convertSwitchValue($dataInput['alive']);
//
//            saveDataIntoJson($persons);
//            return true;
//        }
//    }
//    return false;


    if ($_POST['newPassword'] != null){
        $password = encryptPassword($_POST['newPassword']);
    } else {
        $query = 'SELECT password FROM Persons WHERE ID = :ID';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            "ID" => $id
        ));
        $password = $statement->fetch(PDO::FETCH_ASSOC)['password'];
    }

    try {
        $query = 'UPDATE Persons SET first_name = :first_name, last_name = :last_name, nik = :nik, email = :email, 
                   password = :password, birth_date = :birth_date, sex = :sex, role =:role, address = :address, 
                   internal_notes = :internal_notes, alive = :alive WHERE ID = :ID';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            "ID" => $id,
            "first_name" => ucfirst($dataInput['firstName']),
            "last_name" => ucfirst($dataInput['lastName']),
            "nik" => $dataInput['nik'],
            "email" => $dataInput['email'],
            "password" => $password,
            "birth_date" => convertStringIntoDate('Y-m-d', $dataInput['birthDate']),
            "sex" => $dataInput['sex'],
            "role" => $dataInput['role'],
            "address" => $dataInput['address'],
            "internal_notes" => ucfirst($dataInput['internalNotes']),
            "alive" => convertSwitchValue($dataInput['alive'])
        ));
        $_SESSION['info'] = "Person data has been updated!";
    }catch (PDOException $e ) {
        $_SESSION['error'] = 'Query error: ' . $e->getMessage();
        $_SESSION['inputData'] = $dataInput;
        header('Location: ../edit.php?person='. $id . '&error=1');
        die();
    }
}

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


    saveUpdateData($_SESSION['personId'], inputData(), $PDO);

//    redirect("../view.php", $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId'] . "&saved=2");
    redirect("../view.php", $url . "page=" . $_SESSION['page'] . "&person=" . $_SESSION['personId']);

}