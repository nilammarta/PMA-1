<?php
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/common-action.php";

require_once __DIR__ . "/../includes/pma-db.php";

session_start();

//$jsonData = loadDataIntoJson("persons.json");

if (isset($_POST['login'])) {
    $email = $_POST['email'];

// conditional untuk meng-redirect page contoh dari login menuju dashboard
    if (check() != null) {
        $_SESSION['userEmail'] = $_POST['email'];
        $_SESSION['userName'] = check()['first_name'];
        $_SESSION['logout'] = check()['last_logged_in'];
        $_SESSION['userRole'] = check()['role'];

        header("Location: ../dashboard.php");
        exit();

    } else {
        redirect("../login.php", "error=1");
    }
}

/**
 * @param array $tempData
 * @return array|null
 * function to check if combination of email input and password input exist in json file
 */
function check(): array|null
{
    global $PDO;

    $query = 'SELECT * FROM Persons WHERE email = :email';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
        'email' => $_POST['email']
    ));
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify($_POST['password'], $user['password']) && $user['alive'] == 1){
        return $user;
    }else{
        return null;
    }
}
