<?php
require_once __DIR__ . "/../assets/jsonHelper.php";


function userLoginCheck(string $email)
{
    if (!isset($email)) {
        header("Location: login.php");
        exit();
    }
}

function getPersonsData(): array
{
    return loadDataIntoJson("persons.json");
}

// function untuk redirect page
function redirect($url, $getParams)
{
    header('Location: ' . $url . '?' . $getParams);
    die();
}

// function untuk mendapatkan umur user
function getAge(int $date): int
{
//    untuk mendapatkan selisih timestamp dari waktu saat ini dengan timestamp tgl lahirnya
    $age = time() - $date;
//    floor digunakan untuk pembulatan keatas
    return floor($age / (60 * 60 * 24 * 365)); // (menit, jam, hari, tahun)
}

function getStatus(bool $status): string
{
    if ($status == true){
        return 'Alive';
    }else{
        return "Passed Away";
    }
}

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

function gender(string $gender):string
{
    if($gender == "f"){
        return "Female";
    }else{
        return "Male";
    }
}

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

// validate NIK
function checkNik (string $nik): string|null
{
    if (strlen($nik) == 16 && preg_match("/^[0-9]*$/", $nik)){
        return $nik;
    } else {
        return null;
    }
}

// validate Email
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

//    $verify = password_verify($currentPassword, $thePerson['password']);
//    if ($verify){
//        return true;
//    }else{
//        return false;
//    }

    if ($currentPassword == $thePerson['password']){
        return true;
    }else{
        return false;
    }
}

function encryptPassword(string $password):string
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function convertSwitchValue($value):bool
{
    if ($value == "on"){
        return true;
    }else{
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
        $validate['nik'] = "NIK is already exists in database, please type another NIK!";
    }

    if (checkFormatEmail($email) == null){
        $validate['email'] = "Email format is not correct, please type again!";
    }

    if (isEmailExists($email, $id) == true){
        $validate['email'] = "Email is already exists in database, please type another email!";
    }

    $timestamp = convertStringIntoDate('Y-m-d', $birthDate);
    if (time() < $timestamp){
        $validate['birthDate'] = "Birth Date is not correct, please type again!";
    }

    return $validate;
}

function newPasswordValidate(string $newPass, string $confirmPass): string
{

    if (checkInputPassword($newPass) == null){
        return "Password input is not correct, password must have at least 1 capital letter, 1 non capital letter and 1 number,
        with minimum of 8 characters and maximum 16 characters!";
    }

    if ($confirmPass != $newPass){
        return "Password input is not correct, password must have at least 1 capital letter, 1 non capital letter and 1 number,
        with minimum of 8 characters and maximum 16 characters!";
    }

    return "";
}

function passwordValidate(int $id, string $currentPassword, string $newPassword, string $confirmPassword):array
{
    $validate = [];
    if ($currentPassword != null){
        if (isMatchCurrentPassword($id, $currentPassword) == false){
            $validate['currentPass'] = "Password input is not correct";
        }else{
            $errorNewPass = newPasswordValidate($newPassword, $confirmPassword);
            if ($errorNewPass != "") {
                $validate['newPass'] = $errorNewPass;
            }
        }
    }else{
        $validate['currentPass'] = "Please input the current password first!";
    }

    return $validate;
}