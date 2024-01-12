<?php
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/common-action.php";

session_start();

$jsonData = loadDataIntoJson("persons.json");

if (isset($_POST['login'])) {
    $email = $_POST['email'];

// conditional untuk meng-redirect page contoh dari login menuju dashboard
    if (check($jsonData)) {
        $_SESSION['userEmail'] = $_POST['email'];
        $_SESSION['userName'] = check($jsonData)['firstName'];
        $_SESSION['logout'] = check($jsonData)['lastLoggedIn'];
        $_SESSION['userRole'] = check($jsonData)['role'];

        header("Location: ../dashboard.php");
        exit();

    } else {
        redirect("../login.php", "error=1");
    }
}

/**
 * @param array $tempData
 * @return array|null
 * function to check if combination of email input and password input exist in json file
 */
function check(array $tempData): array|null
{
    for ($i = 0; $i < count($tempData); $i++) {
        if ($_POST["email"] == $tempData[$i]["email"] && password_verify($_POST["password"], $tempData[$i]["password"]) && $tempData[$i]["alive"]) {
            return $tempData[$i];
        }
    }
    return null;
}
