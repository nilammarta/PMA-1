<?php

require_once __DIR__ . "/action/common-action.php";

session_start();

if (isset($_SESSION['userEmail'])){
    redirect("dashboard.php", "");
}else{
    redirect("login.php", "");
}


