<?php
require_once __DIR__ . "/jsonHelper.php";

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
 * function to redirect to another page
 */
function redirect($url, $getParams):void
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
 * function to get user data by id
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
 * function to convert the gender of persons if gender (f) => female, if gender (m) =>male
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
 * function to validate nik input
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
 * function to check
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

function checkFormatEmail($newEmail):string | null
{
    if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $newEmail)){
        return $newEmail;
    }else{
        return null;
    }
}

// Validate Password
function checkInputPassword($newPassword):string|null
{
//    if (strlen($newPassword) > 16 || strlen($newPassword) < 8){
    if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/", $newPassword)){
        return null;
    }else{
        return $newPassword;
    }
}

function isMatchCurrentPassword(int $id, string $currentPassword): bool
{
    $thePerson = getUserById($id);

    $verify = password_verify($currentPassword, $thePerson['password']);
    if ($verify){
        return true;
    }else{
        return false;
    }
}

function encryptPassword(string $password):string
{
    return password_hash($password, PASSWORD_DEFAULT);
}

// function to convert switch value
function convertSwitchValue($value):bool
{
    if ($value == "on"){
        return true;
    } else {
        return false;
    }
}


// function to convert input string into timestamp
function convertStringIntoDate(string $format, string $birthDate): int|null
{
    $dateFormat = date_create_from_format($format, $birthDate);
    if ($dateFormat) {
        $timeStamp = date_format($dateFormat, 'U');
        return ($timeStamp);
    } else {
        return null;
    }
}

function inputData ():array
{
    return [
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "nik" => $_POST['nik'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "birthDate" => $_POST['birthDate'],
        "sex" => $_POST['sex'],
        "address" => $_POST['address'],
        "internalNotes" => $_POST['internalNotes'],
        "role" => $_POST['role'],
        "alive" => $_POST['alive']
    ];
}

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

function newPasswordValidate(string $newPass, string $confirmPass): string | null
{
    if (checkInputPassword($newPass) == null){
        return "Password input is not correct!" .  "<br>"  . "* password must have at least 1 capital letter" . "<br>" . "* 1 non capital letter and 1 number " .
        "<br>" . "* with minimum of 8 characters and maximum 16 characters!";
    }

    if ($newPass != $confirmPass){
        return "New Password and Confirm Password did not match!";
    }

    return null;
}

function passwordValidate(int $id, string $currentPassword, string $newPassword, string $confirmPassword):array
{
    $validate = [];
    if ($currentPassword != null){
        if (!isMatchCurrentPassword($id, $currentPassword)){
            $validate['currentPass'] = "Password input is not correct!";
        }else{
            if (empty($newPassword)){
                $validate['newPass'] = "Please type the New Password!";
            }

            if (empty($confirmPassword)){
                $validate['confirmPass'] = "Please type the Confirm Password!";
            }

            $errorNewPass = newPasswordValidate($newPassword, $confirmPassword);
            if ($errorNewPass != null) {
                $validate['passError'] = $errorNewPass;
            }
        }
    }else{
        $validate['currentPass'] = "Please input the current password first!";
    }

    return $validate;
}

