<?php
require_once __DIR__ . "/json-helper.php";

/**
 * @param string|null $email
 * @return void
 * function to check if user has been login or not
 */
function checkUserLogin(string | null $email): void
{
    if (!isset($email) | $email == null) {
        header("Location: login.php");
        exit();
    }
}

/**
 * @param $email
 * @return array
 * function to get user login data
 */
function userLogin($email):array
{
    $persons = getPersonsData();
    for ($i =0; $i < count($persons); $i++){
        if($persons[$i]["email"] == $email){
            return $persons[$i];
        }
    }
    return [];
}

/**
 * @param string $role
 * @return void
 * function to check user login role, if user login is a MEMBER => redirect to dashboard page
 */
function checkUserLoginRole(string $role): void
{
    if ($role == "MEMBER"){
        redirect("dashboard.php", "");
    }
}

/**
 * @return array
 * function to get all persons data from json file
 */
function getPersonsData(): array
{
    return loadDataIntoJson("persons.json");
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
    if ($status == true){
        return 'Alive';
    }else{
        return "Passed Away";
    }
}

/**
 * @param int $id
 * @return array
 * function to get user data based on id
 */
function getUserById(int $id):array
{
    $persons = getPersonsData();
    foreach ($persons as $person){
        if ($person['id'] == $id){
            return $person;
        }
    }
    return [];
}

/**
 * @param string $gender
 * @return string of gender
 * function to convert the gender of persons if gender (f) => female, if gender (m) => male
 */
function gender(string $gender):string
{
    if($gender == "f"){
        return "Female";
    }else{
        return "Male";
    }
}

/**
 * @param string $nik
 * @param int|null $id
 * @return bool
 * function to check if NIK input is exits in json file or not, TRUE if nik exits and FALSE if nik is not exits
 */
function isNikExits(string $nik, int|null $id):bool
{
    $personsData = getPersonsData();
    foreach ($personsData as $person){
        if ($id == null) {
            if ($person['nik'] == $nik) {
                return true;
            }
        }else{
            if ($person['nik'] == $nik && $person['id'] != $id){
                return true;
            }
        }
    }
    return false;
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
    $persons = getPersonsData();
    foreach ($persons as $person){
        if ($id == null) {
            if ($person['email'] == $newEmail) {
                return true;
            }
        }else{
            if ($person['email'] == $newEmail && $person['id'] != $id){
                return true;
            }
        }
    }
    return false;
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
function convertSwitchValue($value):bool
{
    if ($value == "on"){
        return true;
    } else {
        return false;
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
        "alive" => $_POST['alive']
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
        return "Password input is not correct!" . "<br>" . "* password must have at least 1 capital letter" . "<br>" . "* 1 non capital letter and 1 number " .
        "<br>" . "* with minimum of 8 characters and maximum 16 characters!";
    }

    if ($newPass != $confirmPass){
        return "New Password and Confirm Password did not match!";
    }

    return null;
}


