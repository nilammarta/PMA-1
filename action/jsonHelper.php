<?php
function loadDataIntoJson(string $fileName): null|array
{
    $path = __DIR__ . "/../assets/json/" . $fileName;
    if (file_exists($path)) {
        $data = file_get_contents($path);
        $results = json_decode($data, true);
        if ($results == null) {
            return [];
        }
        return $results;
    }
    return null;
}

function saveDataIntoJson(array $personsData): void
{
    $json = json_encode($personsData, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . "/../assets/json/persons.json", $json);
}