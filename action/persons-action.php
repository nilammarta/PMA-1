<?php
require_once __DIR__ . "/json-helper.php";
require_once "includes/pma-db.php";
global $PDO;

/**
 * @param array $persons
 * @param string $searchInput
 * @return array|null
 * function to get search result based on search input
 */
function searchPerson(string $searchInput): array|null
{
    global $PDO;
//    $search = urldecode($searchInput);
//    $results = [];
//    $resultsLastName = [];
//    if (isset($search)) {
//        foreach ($persons as $value) {
//            if (preg_match("/$search/i", $value["first_name"]) == 1) {
//                $results [] = $value;
//            }
//        }
//
//        foreach ($persons as $value) {
//            if (preg_match("/$search/i", $value["last_name"]) == 1) {
//                $resultsLastName[] = $value;
//            }
//        }
//
//        foreach ($resultsLastName as $result) {
//            if (in_array($result, $results) == 0) {
//                $results[] = $result;
//            }
//        }
//
//        if (count($results) != null) {
//            return $results;
//        }
//    }
//    return null;

    $query = "SELECT * FROM Persons WHERE email LIKE '%$searchInput%' OR first_name LIKE '%$searchInput%' OR last_name LIKE '%$searchInput%'";
//    $query = 'SELECT * FROM Persons WHERE email LIKE :email OR first_name LIKE :first_name OR last_name LIKE :last_name';
    $statement = $PDO->prepare($query);
//    $statement->execute(array(
//        'email' => $searchInput,
//        'first_name' => $searchInput,
//        'last_name' => $searchInput
//    ));
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param string $filterValue
 * @return array|null
 * function to filtering the persons data based on string filter value
 */
function filter(string $filterValue, array $persons): array|null
{
    global $PDO;
    if ($filterValue == "productive"){
        $adult = [];
        foreach ($persons as $person) {
            if (getAge($person["birth_date"]) > 15 && getAge($person['birth_date']) <= 64) {
                $adult[] = $person;
            }
        }
        return $adult;

//        $max = time() - (15 * (60 * 60 * 24 * 365));
//        $min = time() - (64 * (60 * 60 * 24 * 365));
//        $query = "SELECT * FROM Persons WHERE birth_date >= $min AND birth_date <= $max";
//        $statement = $PDO->prepare($query);
//        $statement->execute();
//        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } elseif ($filterValue == "elderly"){
        $elderly = [];
        foreach ($persons as $person){
            if (getAge($person['birth_date']) > 64){
                $elderly[] = $person;
            }
        }
        return $elderly;

//        $min = time() - (64 * (60 * 60 * 24 * 365));
//        echo $min;
//        $query = "SELECT * FROM Persons WHERE birth_date < :date";
//        $statement = $PDO->prepare($query);
//        $statement->execute(array(
//            'date' => $min
//        ));
//        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } elseif ($filterValue == "children"){
        $child = [];
        foreach ($persons as $person) {
            if (getAge($person["birth_date"]) <= 15) {
                $child [] = $person;
            }
        }
        return $child;

//        $max = time() - (15 * (60 * 60 * 24 * 365));
//        echo $max;
//        $query = "SELECT * FROM Person WHERE birth_date >'$max'";
//        $statement = $PDO->prepare($query);
//        $statement->execute();
//        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } elseif ($filterValue == "male") {
        $male = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "M") {
                $male [] = $person;
            }
        }
        return $male;
//        $query = 'SELECT * FROM Persons WHERE sex = :sex';
//        $statement = $PDO->prepare($query);
//        $statement->execute(array(
//            'sex' => "M"
//        ));
//        return $statement->fetchAll(PDO::FETCH_ASSOC);

    } elseif ($filterValue == "female"){
        $female = [];
        foreach ($persons as $person) {
            if ($person["sex"] == "F") {
                $female [] = $person;
            }
        }
        return $female;
//        $query = 'SELECT * FROM Persons WHERE sex = :sex';
//        $statement = $PDO->prepare($query);
//        $statement->execute(array(
//            'sex' => 'F'
//        ));
//        return $statement->fetchAll(PDO::FETCH_ASSOC);

    } elseif ($filterValue == "passedAway"){
        $passed = [];
        foreach ($persons as $person){
            if (!$person["alive"]){
                $passed[] = $person;
            }
        }
        return $passed;
//        $query = 'SELECT * FROM Persons WHERE alive = :alive';
//        $statement = $PDO->prepare($query);
//        $statement->execute(array(
//           'alive' => 0
//        ));
//        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }elseif ($filterValue == "allPersons"){
//        $query = 'SELECT * FROM Persons';
//        $statement = $PDO->prepare($query);
//        $statement->execute();
//        return $statement->fetchAll(PDO::FETCH_ASSOC);
        return $persons;

    } else {
        return null;
    }
}

/**
 * @param array $data
 * @param int $page
 * @param int $limit
 * @return array
 * function to get paginated data
 */
function getPaginatedData(array $data, int $page, int $limit, string | null $search, string | null $filter): array
{
    global $PDO;
////   untuk mendapatkan jumlah halaman yang di perlukan dengan membagi antara banyak data dengan limit yang di tentukan
//    $totalPage = ceil((float)count($data) / (float)$limit);
////   untuk mendapatkan index dari data person yang akan di mulai dari setiap halaman
//    $indexStart = ($page - 1) * $limit;
//    $length = $limit;
//    if (($indexStart + $limit) > count($data)) {
//        $length = count($data) - $indexStart;
//    }
//
//    return [
//        "totalPage" => $totalPage,
//        "pagingData" => array_slice($data, $indexStart, $length),
//        "currentPage" => $page,
//    ];





    $offset = ($page - 1) * $limit;

    if ($search != null && $filter != null){
        $query = "SELECT * FROM Persons WHERE email LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' LIMIT $limit OFFSET $offset";
//    $query = 'SELECT * FROM Persons WHERE email LIKE :email OR first_name LIKE :first_name OR last_name LIKE :last_name';
        $statement = $PDO->prepare($query);

        $statement->execute();
        $searchResult = $statement->fetchAll(PDO::FETCH_ASSOC);
        $pagingData = filter($filter, $searchResult);
        $totalData = count($searchResult);
    }else {
        $dataQuery = "SELECT count(*) FROM Persons";
        $dataStatement = $PDO->query($dataQuery);
        $totalData = $dataStatement->fetchColumn();

        $query = "SELECT * FROM Persons LIMIT $limit OFFSET $offset";
        $statement = $PDO->prepare($query);
        $statement->execute();
        $pagingData = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    $totalPage = ceil((float)$totalData / (float)$limit);


    return [
      "totalPage" => $totalPage,
      "pagingData" => $pagingData,
      "currentPage" => $page
    ];
}

/**
 * @param string $filterValue
 * @return string
 * function to get filter by filter value
 */
function getFilter(string $filterValue): string
{
    if ($filterValue == "productive"){
        return "In Productive Age (15-64 y.o)";
    } elseif ($filterValue == "elderly"){
        return "Elderly ( > 64 y.o)";
    } elseif ($filterValue == "children"){
        return "Children (0-15 y.o)";
    } else if ($filterValue == "male"){
        return "Male";
    } else if ($filterValue == "female"){
        return "Female";
    }else if ($filterValue == "passedAway"){
        return "PassedAway";
    }else{
        return "All Persons Data";
    }
}

/**
 * @param string $filter
 * @return string
 * function to get filter value
 */
function getFilterValue(string $filter): string
{
    if ($filter == "productive"){
        return "productive";
    } else if ($filter == "elderly"){
        return "elderly";
    } elseif ($filter == "children"){
        return "children";
    } elseif ($filter == "male"){
        return "male";
    } elseif ($filter == "female"){
        return "female";
    } elseif ($filter == "passedAway"){
        return "passedAway";
    }else{
        return "allPersons";
    }
}