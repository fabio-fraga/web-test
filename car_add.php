<?php

session_start();

$chassis = $_POST["chassis"];
$model = $_POST["model"];
$brand = $_POST["brand"];
$year = $_POST["year"];
$color = $_POST["color"];
$mileage = $_POST["mileage"];

$fp = fopen("cars.csv", "r");

while (($row = fgetcsv($fp)) !== false) {
    if ($row[0] === $chassis) {

        $_SESSION["data_car"] = [
            "model" => $_POST["model"],
            "brand" => $_POST["brand"],
            "year" => $_POST["year"],
            "color" => $_POST["color"],
            "mileage" => $_POST["mileage"]
        ];

        header("location: /home.php?err=Car already registered!");
        exit;
    }
}

$fp = fopen("cars.csv", "a");

fputcsv($fp, [$chassis, $model, $brand, $year, $color, $mileage]);

fclose($fp);

unset($_SESSION["data_car"]);

header("location: /home.php");

?>