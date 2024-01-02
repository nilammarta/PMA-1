<?php

require_once __DIR__ . "/action/common-action.php";

session_start();

function loginCheck($userEmail): void
{
    if (isset($userEmail)){
        redirect("dashboard.php", "");
    }else{
        redirect("login.php", "");
    }
}

loginCheck($_SESSION['userEmail']);