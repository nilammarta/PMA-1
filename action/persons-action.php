<?php
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/dashboard-action.php";
require_once "includes/pma-db.php";
global $PDO;


/**
 * @param string $filterValue
 * @return array|null
 * function to filtering the persons data based on string filter value and array of search result
 */
function getCountSearchFilter(string $filterValue, string $searchInput): int|null
{
    global $PDO;
    $querySearch = "SELECT COUNT(*) FROM Persons WHERE (email LIKE '%$searchInput%' OR first_name LIKE '%$searchInput%' OR last_name LIKE '%$searchInput%')";

    if ($filterValue == "productive") {
        $query = $querySearch . " AND YEAR(NOW()) - YEAR(birth_date) >= 17 AND YEAR(NOW()) - YEAR(birth_date) <= 65 AND alive = :alive";
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'alive' => 1
        ));
        return $statement->fetchColumn();

    } elseif ($filterValue == "elderly") {
        $query = $querySearch . " AND YEAR(NOW()) - YEAR(birth_date) > 65 AND alive = :alive";
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            "alive" => 1
        ));
        return $statement->fetchColumn();

    } elseif ($filterValue == "children") {

        $query = $querySearch . " AND YEAR(NOW()) - YEAR(birth_date) < 17 AND alive = :alive";
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'alive' => 1
        ));

        return $statement->fetchColumn();

    } elseif ($filterValue == "male") {
        $query = $querySearch . " AND sex = :gender AND alive = :alive";
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'gender' => "M",
            'alive' => 1
        ));
        return $statement->fetchColumn();

    } elseif ($filterValue == "female") {
        $query = $querySearch . " AND sex = :gender AND alive = :alive";
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'gender' => 'F',
            'alive' => 1
        ));
        return $statement->fetchColumn();

    } elseif ($filterValue == "passedAway") {
       $query = $querySearch . " AND alive = :alive";
       $statement = $PDO->prepare($query);
       $statement->execute(array(
           'alive' => 0
       ));
       return $statement->fetchColumn();

    } elseif ($filterValue == "allPersons") {
        $query = $querySearch;
        $statement = $PDO->prepare($query);
        $statement->execute();
        return $statement->fetchColumn();
    } else {
        return null;
    }

}

/**
 * @param string $filterValue
 * @param int $limit
 * @param int $offset
 * @return array|null
 * function to filtering data based on string of filter value
 */
function searchFilterData(string $filterValue, int $limit, int $offset, string|null $search): array|null
{
    global $PDO;

    $querySearch = "SELECT * FROM Persons WHERE (email LIKE '%$search%' OR first_name LIKE '%$search%' OR last_name LIKE '%$search%')";

    if ($filterValue == "productive"){
        if ($search != null){
            $query = $querySearch . " AND YEAR(NOW()) - YEAR(birth_date) >= 17 AND YEAR(NOW()) - YEAR(birth_date) <= 65 AND alive = :alive LIMIT $limit OFFSET $offset";
            $totalData = getCountSearchFilter($filterValue, $search);
        }else{
            $query = "SELECT * FROM Persons WHERE YEAR(NOW()) - YEAR(birth_date) >= 17 AND YEAR(NOW()) - YEAR(birth_date) <= 65 AND alive = :alive LIMIT $limit OFFSET $offset";
            $totalData = getCountPersonsByCategory($filterValue);
        }

        $statement = $PDO->prepare($query);
        $statement->execute(array(
            "alive" => 1
        ));
        $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);

        return [
            'totalData' => $totalData,
            'pagingData' => $pageFilter
        ];
    }else if ($filterValue == "elderly"){
        if ($search != null) {
            $query = $querySearch . " AND YEAR(NOW()) - YEAR(birth_date) > 65 AND alive = :alive LIMIT $limit OFFSET $offset";
            $totalData = getCountSearchFilter($filterValue, $search);
        } else{
            $query = "SELECT * FROM Persons WHERE YEAR(NOW()) - YEAR(birth_date) > 65 AND alive = :alive LIMIT $limit OFFSET $offset";
            $totalData = getCountPersonsByCategory($filterValue);
        }

        $statement = $PDO->prepare($query);
        $statement->execute(array(
            "alive" => 1
        ));
        $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);

        return [
            'totalData' => $totalData,
            'pagingData' => $pageFilter
        ];

    }else if ($filterValue == "children"){
        if ($search != null){
            $query = $querySearch . " AND YEAR(NOW()) - YEAR(birth_date) < 17 AND alive = :alive LIMIT $limit OFFSET $offset";
            $totalData = getCountSearchFilter($filterValue, $search);
        }else{
            $query = "SELECT * FROM Persons WHERE YEAR(NOW()) - YEAR(birth_date) < 17 AND alive = :alive LIMIT $limit OFFSET $offset";
            $totalData = getCountPersonsByCategory($filterValue);
        }

        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'alive' => 1
        ));
        $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
        return [
            'totalData' => $totalData,
            'pagingData' => $pageFilter
        ];
    }else if ($filterValue == "male"){
        if ($search != null){
            $query = $querySearch . " AND sex = :gender AND alive = :alive LIMIT $limit OFFSET $offset";
            $totalData = getCountSearchFilter($filterValue, $search);
        }else{
            $query = "SELECT * FROM Persons WHERE sex = :gender AND alive = :alive LIMIT $limit OFFSET $offset";
            $totalData = getCountPersonsByCategory($filterValue);
        }

        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'gender' => "M",
            'alive' => 1
        ));
        $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
        return [
            'totalData' => $totalData,
            'pagingData' => $pageFilter
        ];
    }else if ($filterValue == "female"){
        if ($search != null){
            $query = $querySearch . " AND sex = :gender AND alive = :alive LIMIT $limit OFFSET $offset";
            $totalData = getCountSearchFilter($filterValue, $search);
        }else{
            $query = "SELECT * FROM Persons WHERE sec = :gender AND alive = :alive";
            $totalData = getCountPersonsByCategory($filterValue);
        }

        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'gender' => 'F',
            'alive' => 1
        ));
        $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);

        return [
            'totalData' => $totalData,
            'pagingData' => $pageFilter
        ];
    }else if ($filterValue == "passedAway"){
        if ($search != null){
            $query = $querySearch . " AND alive = :alive";
            $totalData = getCountSearchFilter($filterValue, $search);
        }else{
            $query = "SELECT * FROM Persons WHERE alive = :alive";
            $totalData = getCountPersonsByCategory($filterValue);
        }

        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'alive' => 0
        ));
        $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
        return [
            'totalData' => $totalData,
            'pagingData' => $pageFilter
        ];
    }else if ($filterValue == "allPersons"){
        if ($search != null){
            $query = $querySearch . " LIMIT $limit OFFSET $offset";
            $totalData = getCountSearchFilter($filterValue, $search);
        }else{
            $query = "SELECT * FROM Persons LIMIT $limit OFFSET $offset";
            $totalData = getCountPersonsByCategory($filterValue);
        }

        $statement = $PDO->prepare($query);
        $statement->execute();
        $pageFilter = $statement->fetchAll(PDO::FETCH_ASSOC);
        return [
            'totalData' => $totalData,
            'pagingData' => $pageFilter
        ];

    }else{
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
function getPaginatedData(int $page, int $limit, string | null $search, string | null $filter): array
{
    global $PDO;

    $offset = ($page - 1) * $limit;

    if ($search != null || $filter != null){
//        // mencari search results
        $searchFilter = searchFilterData(filterValue: $filter, limit: $limit, offset: $offset,search: $search);
        $pagingData = $searchFilter['pagingData'];
        $totalData = $searchFilter['totalData'];
    }else {
        $dataQuery = 'SELECT count(*) FROM Persons';
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
        return "In Productive Age (17-65 y.o)";
    } elseif ($filterValue == "elderly"){
        return "Elderly ( > 65 y.o)";
    } elseif ($filterValue == "children"){
        return "Children (0-16 y.o)";
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
 * @param string|null $filter
 * @return string
 * function to get filter value
 */
function getFilterValue(string|null $filter): string
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