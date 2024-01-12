<?php
/**
 * @param string $fileName
 * @return array|null
 * function to load data from json file
 */
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

/**
 * @param array $personsData
 * @return void
 * function to save new data into json
 */
function saveDataIntoJson(array $personsData): void
{
    $json = json_encode($personsData, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . "/../assets/json/persons.json", $json);
}