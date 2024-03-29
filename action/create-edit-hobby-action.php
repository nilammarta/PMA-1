<?php

require_once __DIR__ . "/../includes/pma-db.php";
require_once "common-action.php";

session_start();

/**
 * @param int $personId
 * @param string $hobby
 * @return void
 * function to save new hobby data
 */
function saveHobby(int $personId, string $hobby):void
{
    global $PDO;
    if (isset($_GET['hobbyId'])) {
        try{
            $query = 'UPDATE Hobbies SET hobby_name = :hobby_name WHERE ID = :jobId';
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'jobId' => $_GET['hobbyId'],
                'hobby_name' => $hobby
            ));
            $_SESSION['info'] = "Hobby data has been updated!";
        }catch (PDOException $e){
            $_SESSION['error'] = "Query error: " . $e->getMessage();
            header("Location: ../hobbies/edit-hobby.php");
            exit();
        }
    }else {
        try {
            $query = 'INSERT INTO Hobbies(person_id, hobby_name) VALUES (:personId, :hobby)';
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'personId' => $personId,
                'hobby' => $hobby
            ));
            $_SESSION['info'] = 'New Hobby data has been saved!';
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Query error:' . $e->getMessage();
            header('Location: ../hobbies/create-hobby.php');
            exit();
        }
    }
}

/**
 * @param int $personId
 * @param int|null $hobbyId
 * @param string $hobby
 * @return bool
 * function to check if hobby exists or not in database
 */
function isHobbyExists(int $personId, int|null $hobbyId, string $hobby): bool
{
    global $PDO;
    $query = 'SELECT * FROM Hobbies WHERE hobby_name = :hobby AND person_id = :personId';
    $queryParams = array(
        'personId' =>$personId,
        'hobby' => $hobby
    );

    if ($hobbyId != null){
        $query = $query . " AND ID != :hobbyId";
        $queryParams ['hobbyId'] = $hobbyId;
    }

    $statement = $PDO->prepare($query);
    $statement->execute($queryParams);
    $hobbyData = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($hobbyData == []){
        return false;
    }else{
        return true;
    }
}

/**
 * @param int $personId
 * @param int|null $hobbyId
 * @param string $hobby
 * @return string|null
 * function to validate hobby input
 */
function hobbyValidate(int $personId, int|null $hobbyId, string $hobby):string|null
{
    if (isHobbyExists($personId, $hobbyId, $hobby) == true){
        return "Hobby is already exists in database!";
    }else if (empty($hobby) || ctype_space($hobby)){
        return "Please type the correct hobby!";
    }else{
        return null;
    }
}

if (isset($_GET['search']) != null && isset($_GET['filter']) != null){
    $url = "search=" . $_GET['search'] . "&filter=" . $_GET['filter'] . "&";
}else{
    $url = "";
}

$validate = hobbyValidate($_GET['person'], $_GET['hobbyId'], htmlspecialchars(ucfirst($_POST['hobbyName'])));
if ($validate != null){
    $_SESSION['errorHobby'] = $validate;
    $_SESSION['hobbyInput'] = $_POST['hobbyName'];
    if (isset($_GET['hobbyId'])){
        redirect("../hobbies/edit-hobby.php", $url . "page=" . $_GET['page'] . "&person=" . $_GET['person'] ."&hobbyId=" . $_GET['hobbyId']);
    }else {
        redirect("../hobbies/create-hobby.php", $url . "page=" . $_GET['page'] . "&person=" . $_GET['person']);
    }
}else {
    saveHobby($_GET['person'], htmlspecialchars(ucfirst($_POST['hobbyName'])));
    if ($_GET['page'] != null) {
        redirect('../view.php', $url . "page=" . $_GET['page'] . "&person=" . $_GET['person']);
    }else{
        redirect("../my-profile.php","");
    }
}
