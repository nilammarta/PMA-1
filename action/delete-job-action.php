<?php
require_once __DIR__ . "/../includes/pma-db.php";
require_once __DIR__ . "/../action/common-action.php";

session_start();
global $PDO;
$query = 'DELETE FROM Jobs WHERE ID = :jobId';
$statement = $PDO->prepare($query);
$statement->execute(array(
   'jobId' => $_GET['jobId']
));
$_SESSION['deleteInfo'] = "Jobs data has been deleted!";
redirect("../jobs/jobs.php", "");
