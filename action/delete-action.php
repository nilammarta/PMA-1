<?php

require_once __DIR__ . "/common-action.php";
require_once __DIR__ . "/jsonHelper.php";

session_start();

function getCountAdmin(array $persons): int
{
    $admin = [];
    foreach ($persons as $person){
        if ($person['role'] == "ADMIN"){
            $admin [] = $person;
        }
    }
    return count($admin);
}

$persons = getPersonsData();
$admin = getCountAdmin($persons);
if (isset($_SESSION["search"]) != null && isset($_SESSION['filter']) != null) {
    $url = "search=" . $_SESSION['search'] . "&filter=" . $_SESSION['filter'] . "&";
} else {
    $url = "";
}
for ($i = 0; $i < count($persons); $i++) {
    if ($persons[$i]['id'] == $_SESSION['personId']) {
//        validasi ketika email user login sama dengan dengan email yang akan di hapus
        if ($persons[$i]['email'] == $_SESSION['userEmail']) {
            redirect("../view.php", $url . "page="  .$_SESSION['page'] . "&person=" . $_SESSION['personId'] . "&error=2");
//        validasi ketika ada ada 1 user role admin pada database, maka tidak bisa di hapus
        } else if ($persons[$i]['role'] == 'ADMIN'){
            if ($admin != 1) {
                unset($persons[$i]);
                $persons = array_values($persons);
                saveDataIntoJson($persons);
                unset($_SESSION['personId']);
                redirect("../persons.php", "");
            }else{
                redirect("../view.php", $url . "page="  .$_SESSION['page'] . "&person=" . $_SESSION['personId'] . "&error=1");
            }
        }else{
            unset($persons[$i]);
            $persons = array_values($persons);
            saveDataIntoJson($persons);
            unset($_SESSION['personId']);
            redirect("../persons.php", "");
        }
    }
}

