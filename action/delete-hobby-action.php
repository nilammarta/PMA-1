<?php

require_once __DIR__ . "/../includes/pma-db.php";
require_once __DIR__ . "/common-action.php";

session_start();

global $PDO;
$query = 'DELETE FROM Hobbies WHERE ID = :hobbyId';
$statement = $PDO->prepare($query);
$statement->execute(array(
    'hobbyId'=>$_GET['hobbyId']
));
$_SESSION['info'] = "Hobby data has been deleted!";
if (isset($_GET['page'])) {
    redirect("../view.php", "page=" . $_GET['page'] . "&person=" . $_GET['person']);
}else if ($_GET['person'] == null){
    redirect("../my-profile.php","");
}