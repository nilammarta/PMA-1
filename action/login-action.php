<?php

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

// Load data into json
function loadDataIntoJson(string $fileName): null|array
{
  $path = __DIR__ . "/../assets/json/" . $fileName;
  if (file_exists($path)) {
    $data = file_get_contents($path);
    $results = json_decode($data, true);
    if ($results == null) {
      return [];
    }
    return $results;
  }
  return [];
}
$jsonData = loadDataIntoJson("persons.json");


// function untuk mengecek apakah email dan password yang di input cocok atau tidak
function check(array $tempData): bool
{
  for ($i = 0; $i < count($tempData); $i++) {
    if ($_POST["email"] == $tempData[$i]["email"] && $_POST["password"] == $tempData[$i]["password"]) {
      return true;
    }
  }
  return false;
}

//function untuk redirect page
function redirect($url, $getParams)
{
  header('Location: ' . $url . '?' . $getParams);
  die();
}

// conditionals untuk meng-redirect page contoh dari login menuju dashboard
if (check($jsonData)) {
  header('Location: ../dashboard.php');
  die();
} else {
  //  header('Location: ../login.php?error=1');
  //  die();
  redirect("../login.php", "error=1");
}
