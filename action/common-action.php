<?php
require_once __DIR__ . "/../assets/jsonHelper.php";

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

// function untuk mengecek umur user
function checkAge(int $date): int
{
//    untuk mendapatkan selisih timestamp dari waktu saat ini dengan timestamp tgl lahirnya
    $age = time() - $date;
//    floor digunakan untuk pembulatan keatas
    return floor($age / (60 * 60 * 24 * 365)); // (menit, jam, hari, tahun)
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
function checkNik (string $nik):string|null
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
function checkPassword($newPassword):string|null
{
    if (strlen($newPassword) > 16 || strlen($newPassword) < 8){
        return null;
    }else{
        return $newPassword;
    }
}

function convertSwitchValue($value):bool
{
    if ($value == "on"){
        return true;
    }else{
        return false;
    }
}


// function to convert input string
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