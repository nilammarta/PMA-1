<?php

require_once __DIR__ . "/../assets/jsonHelper.php";

//$data = [
//  [
//    "email" => 'lalalulu@gmail.com',
//    "password" => '123456'
//  ],
//
//  [
//    "email" => 'kukikura@gmail.com',
//    "password" => '67890'
//  ]
//];

$jsonData = loadDataIntoJson("/../assets/json/persons.json");

// function untuk mengecek apakah email dan password yang di input cocok atau tidak

function check(array $tempData): array|null
{
    for ($i = 0; $i < count($tempData); $i++) {
        if ($_POST["email"] == $tempData[$i]["email"] && $_POST["password"] == $tempData[$i]["password"]) {
            return $tempData[$i];
        }
    }
    return null;
}

$user = check($jsonData);
$userId = $user["id"];

// function untuk redirect page
function redirect($url, $getParams)
{
  header('Location: ' . $url . '?' . $getParams);
  die();
}

// conditionals untuk meng-redirect page contoh dari login menuju dashboard
if (check($jsonData) != null) {
//  header('Location: ../dashboard.php');
//  die();
    redirect("../dashboard.php", "id=$userId");
//    redirect("../dashboard.php", "login=1");
} else {
  //  header('Location: ../login.php?error=1');
  //  die();
  redirect("../login.php", "error=1");
}

