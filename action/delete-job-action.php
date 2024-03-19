<?php
require_once __DIR__ . "/../includes/pma-db.php";
require_once __DIR__ . "/../action/common-action.php";

session_start();
global $PDO;

$query = 'SELECT count FROM Jobs WHERE ID = :jobId';
$statement = $PDO->prepare($query);
$statement->execute(array(
    'jobId' => $_GET['jobId']
));
$count = $statement->fetch(PDO::FETCH_ASSOC)['count'];

if ($count == "0") {
    $query = 'DELETE FROM Jobs WHERE ID = :jobId';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
        'jobId' => $_GET['jobId']
    ));
    $_SESSION['deleteInfo'] = "Job data has been deleted!";
}else{
    $_SESSION['error'] = "Can not delete this job, because the job is already in use!";
}

if ($_GET['page'] == null){
    redirect("../jobs/jobs.php", "page=1");
}else {
    redirect("../jobs/jobs.php", "page=" . $_GET['page']);
}