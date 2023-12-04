<?php
require_once __DIR__ . "/../assets/jsonHelper.php";


session_start();

$jsonData = loadDataIntoJson("/../assets/json/persons.json");

if (isset($_POST['login'])) {
    $email = $_POST['email'];

// conditionals untuk meng-redirect page contoh dari login menuju dashboard
    if (cek($jsonData)) {
//  header('Location: ../dashboard.php');
//  die();
        $_SESSION['userEmail'] = $_POST['email'];
        $_SESSION['username'] = cek($jsonData)['firstName'];
        header("Location: ../dashboard.php");
        exit();

    } else {
        redirect("../login.php", "error=1");
    }
}

// function untuk mengecek apakah email dan password yang di input cocok atau tidak
function cek(array $tempData): array|null
{
    for ($i = 0; $i < count($tempData); $i++) {
        if ($_POST["email"] == $tempData[$i]["email"] && $_POST["password"] == $tempData[$i]["password"]) {
//            $_SESSION['userEmail'] = $_POST['email'];
            return $tempData[$i];
        }
    }
    return null;
}

// function untuk redirect page
function redirect($url, $getParams)
{
    header('Location: ' . $url . '?' . $getParams);
    die();
}



