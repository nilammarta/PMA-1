<?php
require_once __DIR__ . "/json-helper.php";
require_once __DIR__ . "/../includes/pma-db.php";


/**
 * @param string|null $email
 * @return void
 * function to check if user has been login or not
 */
function checkUserLogin(string | null $email, bool|null $directory = null): void
{
    if (!isset($email) | $email == null && $directory == null) {
        header("Location: login.php");
        exit();
    }else if (!isset($email) | $email == null){
        header("Location: ../login.php");
        exit();
    }
}

/**
 * @param string $role
 * @return void
 * function to check user login role, if user login is a MEMBER => redirect to dashboard page
 */
function checkUserLoginRole(string $role): void
{
    if ($role == "M"){
        redirect("dashboard.php", "");
    }
}

/**
 * @param $url
 * @param $getParams
 * @return void
 * function to redirect the page to another page
 */
function redirect($url, $getParams) : void
{
    header('Location: ' . $url . '?' . $getParams);
    die();
}

/**
 * @param int $id
 * @return array
 * function to get user data based on id
 */
function getUserById(int $id):array
{
    global $PDO;
//    $persons = getPersonsData();
//    foreach ($persons as $person){
//        if ($person['id'] == $id){
//            return $person;
//        }
//    }
//    return [];
    $query = 'SELECT * FROM Persons WHERE ID = :ID';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
        'ID' => $id
    ));
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * @param int $jobID
 * @return array
 * function to get job data based on jobID
 */
function getJobById(int $jobID):array
{
    global $PDO;
    $query = 'SELECT * FROM Jobs WHERE ID = :jobID';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
        'jobID' => $jobID
    ));
    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * @param int|null $jobID
 * @return array
 * function to get all jobs data, except job with job ID
 */
function getJobs(int|null $jobID = null):array
{
    global $PDO;
    if ($jobID != null) {
        $query = 'SELECT * FROM Jobs WHERE ID NOT IN (:jobId)';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'jobId' => $jobID
        ));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $query = 'SELECT * FROM Jobs';
        $statement = $PDO->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

/**
 * @param int $date
 * @return int
 * function to get person age
 */
function getAge(int $date): int
{
//    untuk mendapatkan selisih timestamp dari waktu saat ini dengan timestamp tgl lahirnya
    $age = time() - $date;
//    floor digunakan untuk pembulatan keatas
    return floor($age / (60 * 60 * 24 * 365)); // (menit, jam, hari, tahun)
}

/**
 * @param bool $status
 * @return string
 * function to get status of person if TRUE => person still alive otherwise person passedAway
 */
function getStatus(bool $status): string
{
    if ($status || $status == 1){
        return 'Alive';
    }else{
        return "Passed Away";
    }
}

/**
 * @param string $gender
 * @return string of gender
 * function to convert the gender of persons if gender (f) => female, if gender (m) => male
 */
function getGender(string $gender):string
{
    if($gender == "F"){
        return "Female";
    }else{
        return "Male";
    }
}

/**
 * @param string $role
 * @return string
 * function to convert role value, if role is A, it will be return "ADMIN", if M it will return "MEMBER"
 */
function getRole(string $role): string
{
    if ($role == "A"){
        return "ADMIN";
    }else{
        return "MEMBER";
    }
}

/**
 * @param int $jobId
 * @return string
 * function to get persons job based on person id
 */
function getPersonJob(int $personId): array
{
    global $PDO;

    $queryData = 'SELECT * FROM Persons_Jobs WHERE person_id = :personId';
    $statementData = $PDO->prepare($queryData);
    $statementData->execute(array(
       'personId' => $personId
    ));
    $personJob = $statementData->fetch(PDO::FETCH_ASSOC);

    if ($personJob != null) {
        $jobId = $personJob['job_id'];

        $query = 'SELECT * FROM Jobs WHERE ID = :jobID';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            'jobID' => $jobId
        ));
//        echo $statement->fetch(PDO::FETCH_ASSOC);
        return [
            'jobId' => $jobId,
            'job' => $statement->fetch(PDO::FETCH_ASSOC)['job_name']
        ];
//        return $personJob[0]['job_id'];
    }else{
        return [
            'jobId' => 2,
            'job' => "Jobless"
        ];
    }
}

/**
 * @param int $personId
 * @return array
 * function to get hobby based on person ID
 */
function getPersonHobby(int $personId):array
{
    global $PDO;
    $query = 'SELECT * FROM Hobbies WHERE person_id = :personId';
    $statement = $PDO->prepare($query);
    $statement->execute(array(
       'personId'=>$personId
    ));
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param string $nik
 * @param int|null $id
 * @return bool
 * function to check if NIK input is exits in json file or not, TRUE if nik exits and FALSE if nik is not exits
 */
function isNikExits(string $nik, int|null $id):bool
{
    global $PDO;
//    $personsData = getPersonsData();
//    foreach ($personsData as $person){
//        if ($id == null) {
//            if ($person['nik'] == $nik) {
//                return true;
//            }
//        }else{
//            if ($person['nik'] == $nik && $person['ID'] != $id){
//                return true;
//            }
//        }
//    }
//    return false;
    $query = 'SELECT * FROM Persons WHERE nik = :nik';
    $queryParams = array(
        'nik' => $nik
    );

    if ($id != null){
        $query = $query . " AND ID != :id";
        $queryParams['id'] = $id;
    }

    $statement = $PDO->prepare($query);
    $statement->execute($queryParams);
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($data != null){
        return true;
    }else{
        return false;
    }
}

/**
 * @param string $nik
 * @return string|null
 * function to validate nik input if length of NIK is more than 16 it will return null
 */
function checkNik(string $nik): string|null
{
    if (strlen($nik) == 16 && preg_match("/^[0-9]*$/", $nik)){
        return $nik;
    } else {
        return null;
    }
}

/**
 * @param string $newEmail
 * @param int|null $id
 * @return bool
 * function to check if email input is exist in json file or not
 */
function isEmailExists(string $newEmail, int|null $id): bool
{
    global $PDO;
//    $persons = getPersonsData();
//    foreach ($persons as $person){
//        if ($id == null) {
//            if ($person['email'] == $newEmail) {
//                return true;
//            }
//        }else{
//            if ($person['email'] == $newEmail && $person['ID'] != $id){
//                return true;
//            }
//        }
//    }
//    return false;

    $query = 'SELECT * FROM Persons WHERE email = :email';
    $getParams = array(
        'email' => $newEmail
    );

    if ($id != null){
        $query = $query . ' AND ID != :id';
        $getParams['id'] = $id;
    }

    $statement = $PDO->prepare($query);
    $statement->execute($getParams);
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($data != null){
        return true;
    }else{
        return false;
    }

}

/**
 * @param $newEmail
 * @return string|null
 * function to check email format of the email input
 */
function checkFormatEmail($newEmail):string | null
{
    if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $newEmail)){
        return $newEmail;
    }else{
        return null;
    }
}

/**
 * @param $newPassword
 * @return string|null
 * function to check input password, if password valid it will return new password
 */
function checkInputPassword($newPassword):string|null
{
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/", $newPassword)){
        return null;
    }else{
        return $newPassword;
    }
}

/**
 * @param int $id => id of person
 * @param string $currentPassword => password input
 * @return bool
 * function to check if current password input is match with the current password of the person
 */
function isMatchCurrentPassword(int $id, string $currentPassword): bool
{
//   get the person based on id
    $thePerson = getUserById($id);

//  check current password input is match with the person password
    $verify = password_verify($currentPassword, $thePerson['password']);
    if ($verify){
        return true;
    }else{
        return false;
    }
}

/**
 * @param string $password
 * @return string
 * function to encrypt (hash) password
 */
function encryptPassword(string $password) :string
{
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * @param $value
 * @return bool
 * function to convert switch input if on it will return TRUE, otherwise it wil return FALSE
 */
function convertSwitchValue($value):int
{
    if ($value == "on"){
        return 1;
    } else {
        return 0;
    }
}

/**
 * @param string $format
 * @param string $birthDate
 * @return int|null
 * function to convert string of date into timestamp
 */
function convertStringIntoDate(string $format, string $birthDate): int|null
{
    $dateFormat = date_create_from_format($format, $birthDate);
    if ($dateFormat) {
//      convert date into timestamp
        $timeStamp = date_format($dateFormat, 'U');
        return ($timeStamp);
    } else {
        return null;
    }
}


/**
 * @return array => of input data
 * function to get input data from user as array
 */
function inputData ():array
{
    return [
//      function htmlspecialschars() => to sanitize the string input
        "firstName" => htmlspecialchars($_POST['firstName']),
        "lastName" => htmlspecialchars($_POST['lastName']),
        "nik" => $_POST['nik'],
//      function filter_var() and FILTER SANITIZE EMAIL => to sanitize the input email
        "email" => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
        "password" => $_POST['password'],
        "birthDate" => $_POST['birthDate'],
        "sex" => $_POST['sex'],
        "address" => htmlspecialchars($_POST['address']),
        "internalNotes" => htmlspecialchars($_POST['internalNotes']),
        "role" => $_POST['role'],
        "alive" => $_POST['alive'],
        "jobId" => $_POST['job'],
        "userJob" => $_POST['userJob']
    ];
}

/**
 * @param string $nik
 * @param string $email
 * @param int $id
 * @param string $birthDate
 * @return array
 * function to validate data input and return array of error message
 */
function editValidate(string $nik, string $email, int $id, string $birthDate):array
{
    $validate = [];
    if (checkNik($nik) == null){
        $validate['nik'] = "Please type the correct NIK, at least 16 characters and numeric only!";
    }

    if (isNikExits($nik, $id) == true){
        $validate['nik'] = "NIK is already exists in database!";
    }

    if (checkFormatEmail($email) == null){
        $validate['email'] = "Email format is invalid!";
    }

    if (isEmailExists($email, $id) == true){
        $validate['email'] = "Email is already exists in database!";
    }

    $timestamp = convertStringIntoDate('Y-m-d', $birthDate);
    if (time() < $timestamp || $timestamp == null){
        $validate['birthDate'] = "Birth Date is invalid!";
    }

    return $validate;
}

/**
 * @param string $newPass
 * @param string $confirmPass
 * @return string|null
 * function to validate new password and return error message if password input is invalid
 */
function newPasswordValidate(string $newPass, string $confirmPass): string | null
{
    if (checkInputPassword($newPass) == null){
        return "Password input is not correct!" . "<br>" . "* password must have at least 1 capital letter" . "<br>" . "* 1 non-capital letter and 1 number " .
        "<br>" . "* with minimum of 8 characters and maximum 16 characters!";
    }

    if ($newPass != $confirmPass){
        return "New Password and Confirm Password did not match!";
    }

    return null;
}

/**
 * @param int $id
 * @param array $dataInput
 * @param $PDO
 * @param string|null $flag
 * @return void
 * function to save update person data into mysql database
 */
function saveUpdateData(int $id, array $dataInput, $PDO, string $flagEdit=null):void
{
    if ($_POST['newPassword'] != null) {
        $password = encryptPassword($_POST['newPassword']);
    } else {
        $query = 'SELECT password FROM Persons WHERE ID = :ID';
        $statement = $PDO->prepare($query);
        $statement->execute(array(
            "ID" => $id
        ));
        $password = $statement->fetch(PDO::FETCH_ASSOC)['password'];
    }

    if ($flagEdit !=null) {

        try {
            $query = 'UPDATE Persons SET first_name = :first_name, last_name = :last_name, nik = :nik, email = :email, 
                   password = :password, birth_date = :birth_date, sex = :sex, role =:role, address = :address, 
                   internal_notes = :internal_notes, alive = :alive WHERE ID = :ID';
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                "ID" => $id,
                "first_name" => ucfirst($dataInput['firstName']),
                "last_name" => ucfirst($dataInput['lastName']),
                "nik" => $dataInput['nik'],
                "email" => $dataInput['email'],
                "password" => $password,
                "birth_date" => convertStringIntoDate('Y-m-d', $dataInput['birthDate']),
                "sex" => $dataInput['sex'],
                "role" => $dataInput['role'],
                "address" => $dataInput['address'],
                "internal_notes" => ucfirst($dataInput['internalNotes']),
                "alive" => convertSwitchValue($dataInput['alive'])
            ));
            $_SESSION['info'] = "Person data has been updated!";
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Query error: ' . $e->getMessage();
            $_SESSION['inputData'] = $dataInput;
            header('Location: ../edit.php?person=' . $id . '&error=1');
            die();
        }
    }else{
        if ($_POST['internalNotes'] != null){
            $internalNotes = ucwords($dataInput['internalNotes']);
        }else{
            $query = 'SELECT internal_notes FROM Persons WHERE ID = :ID';
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'ID' => $id
            ));
            $internalNotes = $statement->fetch(PDO::FETCH_ASSOC)['internal_notes'];
        }

        try {
            $query = 'UPDATE Persons SET first_name = :first_name, last_name = :last_name, nik = :nik, email = :email,
                   password = :password, birth_date = :birth_date, sex = :sex, address = :address, 
                   internal_notes = :internal_notes WHERE ID = :ID';
            $statement = $PDO->prepare($query);
            $statement->execute(array(
                'ID' => $id,
                'first_name' => ucfirst($dataInput['firstName']),
                'last_name' => ucfirst($dataInput['lastName']),
                'nik' => $dataInput['nik'],
                'email' => $dataInput['email'],
                'password' => $password,
                'birth_date' => convertStringIntoDate('Y-m-d', $dataInput['birthDate']),
                'sex' => $dataInput['sex'],
                'address' => $dataInput['address'],
                'internal_notes' => $internalNotes,
            ));
        }catch (PDOException $e ) {
            $_SESSION['error'] = 'Query error: ' . $e->getMessage();
            $_SESSION['inputData'] = $dataInput;
            header('Location: ../my-profile.php?person='. $id . '&error=1');
            die();
        }
    }
}

/**
 * @param int|null $newJobId
 * @param int|null $jobId
 * @return void
 * function to update count value in the Jobs database when user edit or delete person data
 */
function updateCountOfJobs(int|null $newJobId, int|null $jobId):void
{
    global $PDO;

    if ($jobId != null) {
        $queryJob = 'UPDATE Jobs SET count = :countJob WHERE ID = :jobId';
        $statementJob = $PDO->prepare($queryJob);
        $statementJob->execute(array(
            'jobId' => $jobId,
            'countJob' => getJobById($jobId)['count'] - 1
        ));
    }

    if ($newJobId != null) {
        $queryUpdate = 'UPDATE Jobs SET count = :count WHERE ID = :jobId';
        $statementUpdate = $PDO->prepare($queryUpdate);
        $statementUpdate->execute(array(
            'jobId' => $newJobId,
            'count' => getJobById($newJobId)['count'] + 1
        ));
    }
}

