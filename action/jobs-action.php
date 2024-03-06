<?php

require_once __DIR__ . "/../includes/pma-db.php";
function getPaginatedJobs(int $limit, int $page, string|null $search = null):array
{
    global $PDO;

    $offset = ($page - 1) * $limit;
    if ($search == null) {
        $queryData = 'SELECT count(*) FROM Jobs';
        $statementData = $PDO->query($queryData);
        $totalData = $statementData->fetchColumn();

        $query = "SELECT * FROM Jobs LIMIT $limit OFFSET $offset";
        $statement = $PDO->prepare($query);
        $statement->execute();
        $pagingData = $statement->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $queryData = "SELECT count(*) FROM Jobs WHERE job_name LIKE '%$search%'";
        $statementData = $PDO->query($queryData);
        $totalData = $statementData->fetchColumn();

        $query = "SELECT * FROM Jobs WHERE job_name LIKE '%$search%' LIMIT $limit OFFSET $offset";
        $statement = $PDO->prepare($query);
        $statement->execute();
        $pagingData = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    $totalPage = ceil((float)$totalData / (float)$limit);

    return[
      'totalPage' => $totalPage,
      'pagingData' => $pagingData,
      'page' => $page
    ];

}

function getCountOfEmployees(int $jobId):int|string
{
    global $PDO;
    $query = 'SELECT count(*) FROM Persons_Jobs WHERE job_id = :job_id';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
        'job_id' => $jobId
    ));
    $total = $statement->fetchColumn();
    if ($total == null){
        return '-';
    }else{
        return $total;
    }
}
