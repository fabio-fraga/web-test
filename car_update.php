<?php

$chassis = $_POST["chassis"];
$model = $_POST["model"];
$brand = $_POST["brand"];
$year = $_POST["year"];
$color = $_POST["color"];
$mileage = $_POST["mileage"];

$temp_file = tempnam('.', '');

$fp_cars_csv = fopen("cars.csv", "r");

$fp_temp_file = fopen($temp_file, "w");

while (($row = fgetcsv($fp_cars_csv)) !== false) {
    if ($row[0] !== $chassis) {
        fputcsv($fp_temp_file, $row);
    } else {
        fputcsv($fp_temp_file, [$row[0], $model, $brand, $year, $color, $mileage]);
    }
}

fclose($fp_cars_csv);
fclose($fp_temp_file);

rename($temp_file, "cars.csv");

header("location: /home.php");

?>