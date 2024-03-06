<?php

require_once __DIR__ . "/../includes/pma-db.php";
require_once __DIR__ . "/common-action.php";


function saveJob(string $jobInput): void
{
    global $PDO;
    try{
        $query = 'INSERT INTO Jobs(job_name, count) VALUES (:job_name, :count)';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'job_name' => $jobInput,
            'count' => 0
        ));
        $_SESSION['info'] = "New job data has been save!";
    } catch(PDOException $e){
        $_SESSION['error'] = 'Query error: ' . $e->getMessage();
        header('Location: ../jobs/jobs.php');
        die();
    }
}

function isJobExists(string $job): bool
{
    global $PDO;
    $query = 'SELECT * FROM Jobs WHERE job_name = :job_name';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
        'job_name' => $job
    ));
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($data != null){
        return true;
    }else{
        return false;
    }
}

function validateJob(string $job):string|null
{
    if (isJobExists($job) == true){
        return "Job ada is exists in database!";
    }elseif (empty($job)){
        return "Please type the correct job!";
    }else{
        return null;
    }
}

$validate = validateJob($_POST['jobName']);
if ($validate == null){
    redirect("../jobs/jobs.php","");
}else{
    $_SESSION['errorJob'] = $validate;
    redirect("../jobs/create-job.php", "");
}


