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
    $statement = $PDO->prepare($query);
    $statement->execute(array(
        'personId' => $personId,
        'hobby' => $hobby
    ));
    $hobbyData = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($hobbyData == null){
        return false;
    }else{
        foreach ($hobbyData as $hobby){
            if ($hobby['ID'] == $hobbyId){
                return false;
            }
        }
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
    }elseif (empty($hobby)){
        return "Please type the correct hobby!";
    }else{
        return null;
    }
}

$validate = hobbyValidate($_GET['person'], $_GET['hobbyId'], ucfirst($_POST['hobbyName']));
if ($validate != null){
    $_SESSION['errorHobby'] = $validate;
    $_SESSION['hobbyInput'] = $_POST['hobbyName'];
    if (isset($_GET['hobbyId'])){
        redirect("../hobbies/edit-hobby.php", "page=" . $_GET['page'] . "&person=" . $_GET['person'] ."&hobbyId=" . $_GET['hobbyId']);
    }else {
        redirect("../hobbies/create-hobby.php", "page=" . $_GET['page'] . "&person=" . $_GET['person']);
    }
}else {
    saveHobby($_GET['person'], ucfirst($_POST['hobbyName']));
    if ($_GET['page'] != null) {
        redirect('../view.php', "page=" . $_GET['page'] . "&person=" . $_GET['person']);
    }else{
        redirect("../my-profile.php","");
    }
}
