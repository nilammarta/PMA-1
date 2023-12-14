<?php
require_once __DIR__ . "/../assets/jsonHelper.php";
require_once __DIR__ . "/common-action.php";

session_start();

$jsonData = loadDataIntoJson("persons.json");

if (isset($_POST['login'])) {
    $email = $_POST['email'];

// conditionals untuk meng-redirect page contoh dari login menuju dashboard
    if (check($jsonData)) {
//  header('Location: ../dashboard.php');
//  die();
        $_SESSION['userEmail'] = $_POST['email'];
        $_SESSION['username'] = check($jsonData)['firstName'];
        $_SESSION['logout'] = check($jsonData)['lastLoggedIn'];
        header("Location: ../dashboard.php");
        exit();

    } else {
        redirect("../login.php", "error=1");
    }
}

// function untuk mengecek apakah email dan password yang di input cocok atau tidak
function check(array $tempData): array|null
{
    for ($i = 0; $i < count($tempData); $i++) {
        if ($_POST["email"] == $tempData[$i]["email"] && $_POST["password"] == $tempData[$i]["password"] && $tempData[$i]["alive"] == true) {
//            $_SESSION['userEmail'] = $_POST['email'];
            return $tempData[$i];
        }
    }
    return null;
}
