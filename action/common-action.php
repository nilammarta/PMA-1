<?php
require_once __DIR__ . "/../assets/jsonHelper.php";

function personsData(): array
{
    return loadDataIntoJson("persons.json");
}

// function untuk mengecek umur user
function checkAge(int $date): int
{
    $total = time() - $date;
    return floor($total / (60 * 60 * 24 * 365));
}

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

function userLogin($email):array
{
    $persons = personsData();
    for ($i =0; $i < count($persons); $i++){
        if($persons[$i]["email"] == $email){
            return $persons[$i];
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

function user(int $id):array
{
    $persons = personsData();
    foreach ($persons as $person){
        if ($person['id'] == $id){
            return $person;
        }
    }
    return [];
}