<?php
require_once __DIR__ . "/../assets/jsonHelper.php";

function personsData(): array
{
    return loadDataIntoJson("/../assets/json/persons.json");
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