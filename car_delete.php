<?php

$chassis = $_GET["chassis"];

$temp_file = tempnam('.', '');

$fp_cars_csv = fopen("cars.csv", "r");

$fp_temp_file = fopen($temp_file, "w");

while (($row = fgetcsv($fp_cars_csv)) !== false) {
    if ($row[0] !== $chassis) {
        fputcsv($fp_temp_file, $row);
    }
}

fclose($fp_cars_csv);
fclose($fp_temp_file);

rename($temp_file, "cars.csv");

header("location: /home.php");

?>