<?php

session_start();

// masukkan data 'lastLoggedIn' ke persons json


session_unset();
session_destroy();

header("Location: login.php");
exit();
