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
function filter(string $filterValue, array|null $persons, int|null $limit, int|null $offset): array|null
{
    global $PDO;
    if ($persons != null) {
        if ($filterValue == "productive") {
            $adult = [];
            foreach ($persons as $person) {
                if (getAge($person["birth_date"]) > 15 && getAge($person['birth_date']) <= 64 && $person['alive'] == 1) {
                    $adult[] = $person;
                }
            }
            return $adult;
        } elseif ($filterValue == "elderly") {
            $elderly = [];
            foreach ($persons as $person) {
                if (getAge($person['birth_date']) > 64 && $person['alive'] == 1) {
                    $elderly[] = $person;
                }
            }
            return $elderly;

        } elseif ($filterValue == "children") {
            $child = [];
            foreach ($persons as $person) {
                if (getAge($person["birth_date"]) <= 15 && $person['alive'] == 1) {
                    $child [] = $person;
                }
            }
            return $child;

        } elseif ($filterValue == "male") {
            $male = [];
            foreach ($persons as $person) {
                if ($person["sex"] == "M") {
                    $male [] = $person;
                }
            }
            return $male;

        } elseif ($filterValue == "female") {
            $female = [];
            foreach ($persons as $person) {
                if ($person["sex"] == "F") {
                    $female [] = $person;
                }
            }
            return $female;

        } elseif ($filterValue == "passedAway") {
            $passed = [];
            foreach ($persons as $person) {
                if (!$person["alive"]) {
                    $passed[] = $person;
                }
            }
            return $passed;

        } elseif ($filterValue == "allPersons") {
            return $persons;
        } else {
            return null;
        }
    }else{
        if ($filterValue == "productive"){
            $max = time() - (15 * (60 * 60 * 24 * 365));
            $min = time() - (64 * (60 * 60 * 24 * 365));
            $queryFilter = "SELECT * FROM Persons WHERE birth_date >= $min AND birth_date <= $max AND alive = :alive";
            $statementFilter = $PDO->prepare($queryFilter);
            $statementFilter->execute(array(
                'alive' => 1
            ));
            $filterData = $statementFilter->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT * FROM Persons WHERE birth_date >= $min AND birth_date <= $max AND alive = :alive LIMIT $limit OFFSET $offset";
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'alive' => 1
            ));
            $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
            return [
                'filterData' => $filterData,
                'pagingData' => $pageFilter
            ];
        }else if ($filterValue == "elderly"){
            $min = time() - (64 * (60 * 60 * 24 * 365));
            $queryFilter = "SELECT * FROM Persons WHERE birth_date < :date AND alive = :alive";
            $statementFilter = $PDO ->prepare($queryFilter);
            $statementFilter->execute(array(
                'date' => $min,
                'alive' => 1
            ));
            $filterData = $statementFilter->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT * FROM Persons WHERE birth_date < :date AND alive = :alive LIMIT $limit OFFSET $offset";
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'date' => $min,
                'alive' => 1
            ));
            $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
            return [
                'filterData' => $filterData,
                'pagingData' => $pageFilter
            ];
        }else if ($filterValue == "children"){
            $max = time() - (15 * (60 * 60 * 24 * 365));
            $queryFilter = "SELECT * FROM Persons WHERE birth_date > :date AND alive = :alive";
            $statementFilter = $PDO->prepare($queryFilter);
            $statementFilter->execute(array(
                'date' => $max,
                'alive' => 1
            ));
            $filterData = $statementFilter->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT * FROM Persons WHERE birth_date > :date AND alive = :alive LIMIT $limit OFFSET $offset";
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'date' => $max,
                'alive' => 1
            ));
            $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
            return [
                'filterData' => $filterData,
                'pagingData' => $pageFilter
            ];
        }else if ($filterValue == "male"){
            $queryFilter = "SELECT * FROM Persons WHERE sex = :sex";
            $statementFilter = $PDO->prepare($queryFilter);
            $statementFilter->execute(array(
               'sex' => "M"
            ));
            $filterData = $statementFilter->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT * FROM Persons WHERE sex = :sex LIMIT $limit OFFSET $offset";
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'sex' => "M"
            ));
            $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
            return [
                'filterData' => $filterData,
                'pagingData' => $pageFilter
            ];
        }else if ($filterValue == "female"){
            $queryFilter = "SELECT * FROM Persons WHERE sex = :sex";
            $statementFilter = $PDO->prepare($queryFilter);
            $statementFilter->execute(array(
               'sex' => 'F'
            ));
            $filterData = $statementFilter->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT * FROM Persons WHERE sex = :sex LIMIT $limit OFFSET $offset";
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'sex' => 'F'
            ));
            $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
            return [
                'filterData' => $filterData,
                'pagingData' => $pageFilter
            ];
        }else if ($filterValue == "passedAway"){
            $queryFilter = "SELECT * FROM Persons WHERE alive = :alive";
            $statementFilter = $PDO->prepare($queryFilter);
            $statementFilter->execute(array(
               'alive' => 0
            ));
            $filterData = $statementFilter->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT * FROM Persons WHERE alive = :alive LIMIT $limit OFFSET $offset";
            $statement = $PDO->prepare($query);
            $statement->execute(array(
               'alive' => 0
            ));
            $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
            return [
                'filterData' => $filterData,
                'pagingData' => $pageFilter
            ];
        }else if ($filterValue == "allPersons"){
            $queryFilter = "SELECT * FROM Persons";
            $statementFilter = $PDO->prepare($queryFilter);
            $statementFilter->execute();
            $filterData = $statementFilter->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT * FROM Persons LIMIT $limit OFFSET $offset";
            $statement = $PDO->prepare($query);
            $statement->execute();
            $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
            return [
                'filterData' => $filterData,
                'pagingData' => $pageFilter
            ];
        }else{
            return null;
        }
    }
}

/**
 * @param array $data
 * @param int $page
 * @param int $limit
 * @return array
 * function to get paginated data
 */
function getPaginatedData(int $page, int $limit, string | null $search, string | null $filter): array
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
        // mencari search results
        $searchResult = searchPerson(searchInput: $search);

        if ($searchResult != null){
            // melakukan filter data berdasarkan kategori
            $filteredData = filter(filterValue: $filter, persons: $searchResult, limit: null, offset: null);
            $pagingData = array_slice($filteredData, $offset, $limit);
            $totalData = count($filteredData);
        }else{
            $pagingData = null;
            $totalData = null;
        }


        // paginated data
//        $query = "SELECT * FROM Persons WHERE email LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%' LIMIT $limit OFFSET $offset";
//        $statement = $PDO->prepare($query);
//        $statement->execute();
//        $searchPaging = $statement->fetchAll(PDO::FETCH_ASSOC);

//        if (($offset + $limit) > count($filteredData)){
//            $limit = count($filteredData) - $offset;
//        }

//        $pagingData = $filteredData['pagingData'];
//        $totalData = count($filteredData['filterData']);
    }else if ($search == null && $filter != null){
        $filteredData = filter(filterValue: $filter, persons: null, limit: $limit, offset: $offset);
        $pagingData = $filteredData['pagingData'];
        $totalData = count($filteredData['filterData']);
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