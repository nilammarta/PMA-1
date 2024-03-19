<?php

require_once __DIR__ . "/../includes/pma-db.php";
require_once __DIR__ . "/common-action.php";

session_start();

/**
 * @param string $jobInput
 * @return void
 * function to save new job data
 */
function saveJob(string $jobInput): void
{
    global $PDO;
    if (isset($_GET['jobId'])){
        try {
            $query = 'UPDATE Jobs SET job_name = :job_name WHERE ID = :ID';
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'ID' => $_GET['jobId'],
                'job_name' => ucwords($_POST['jobName'])
            ));
            $_SESSION['editInfo'] = "Job data has been updated!";
        }catch (PDOException $e){
            $_SESSION['error'] = "Query error: " . $e->getMessage();
        }
    }else {
        try {
            $query = 'INSERT INTO Jobs(job_name, count) VALUES (:job_name, :count)';
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'job_name' => ucwords($jobInput),
                'count' => 0
            ));
            $_SESSION['info'] = "New job data has been saved!";
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Query error: ' . $e->getMessage();
            header('Location: ../jobs/jobs.php');
            die();
        }
    }
}

/**
 * @param string $job
 * @param int|null $jobId
 * @return bool
 * function to check if job exists in the database or not
 */
function isJobExists(string $job, int|null $jobId): bool
{
    global $PDO;

    $query = 'SELECT * FROM Jobs WHERE job_name = :job_name';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
        'job_name' => $job
    ));
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($data != null) {
        foreach ($data as $jobData){
            if ($jobData['ID'] == $jobId){
                return false;
            }
        }
        return true;
    } else {
        return false;
    }
}

/**
 * @param string $job
 * @param int|null $jobId
 * @return string|null
 * function to validate job input
 */
function validateJob(string $job, int|null $jobId):string|null
{
    if (isJobExists($job, $jobId) == true) {
        return "Job is already exists in database!";
    } elseif (empty($job)) {
        return "Please type the correct job!";
    } else {
        return null;
    }
}

$validate = validateJob($_POST['jobName'], $_GET['jobId']);
if ($validate == null){
    saveJob($_POST['jobName']);
    unset($_SESSION['jobId']);
    if ($_GET['page'] == null){
        redirect("../jobs/jobs.php", "");
    }else {
        redirect("../jobs/jobs.php", "page=" . $_GET['page']);
    }
}else{
    $_SESSION['errorJob'] = $validate;
    $_SESSION['jobInput'] = $_POST['jobName'];

    if ($_GET['page'] == null){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }

    if (isset($_GET['jobId'])) {
        redirect("../jobs/edit-job.php", "page=" . $page . "&jobId=" . $_GET['jobId']);
    }else{
        redirect("../jobs/create-job.php", "");
    }
}


