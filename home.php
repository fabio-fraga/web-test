<?php

session_start();

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("location: /login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div style="display: grid; grid-template-columns: repeat(12, 1fr);">
        <div style="grid-column-start: 1; grid-column-end: 12;">
            Olá, <strong><?= $_SESSION["name"] ?></strong>!
        </div>
        <div style="grid-column-start: 12">
            <a style="text-decoration: none;" href="/logout.php">Logout</a>
        </div>
    </div>

    <h3>Register your car:</h3>

    <?php if (isset($_GET['err'])): ?>
        <p style="color: red;">
            <?php echo $_GET['err'] ?>
        </p>
    <?php endif ?>

    <form action="car_add.php" method="POST" style="display: flex; flex-direction: column; width: 30%;">
        Chassis: <input style="margin-bottom: 2%" type="text" name="chassis" minlength="17" maxlength="17" required>
        Model: <input style="margin-bottom: 2%" type="text" name="model" value="<?= $_SESSION["data_car"]["model"] ?? '' ?>" required>
        Brand: <input style="margin-bottom: 2%" type="text" name="brand" value="<?= $_SESSION["data_car"]["brand"] ?? '' ?>" required>
        Year of manufacture: <input style="margin-bottom: 2%" type="number" name="year" value="<?= $_SESSION["data_car"]["year"] ?? '' ?>" required>
        Color: <input style="margin-bottom: 2%" type="text" name="color" value="<?= $_SESSION["data_car"]["color"] ?? '' ?>" required>
        Mileage (km): <input style="margin-bottom: 2%" type="number" name="mileage" value="<?= $_SESSION["data_car"]["mileage"] ?? '' ?>" required>
        <button style="background-color: lightgreen; cursor: pointer;">Register</button>
    </form>

    <h3>Your cars:</h3>
    
    <?php $fp = fopen("cars.csv", "r") ?>

    <?php if ((($row = fgetcsv($fp)) === false)): ?>
        <p>No cars registered!</p>
    <?php else: ?>

        <?php $fp = fopen("cars.csv", "r") ?>

        <table style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 5px;">Chassis</th>
                    <th style="border: 1px solid black; padding: 5px;">Model</th>
                    <th style="border: 1px solid black; padding: 5px;">Brand</th>
                    <th style="border: 1px solid black; padding: 5px;">Year of manufacture</th>
                    <th style="border: 1px solid black; padding: 5px;">Color</th>
                    <th style="border: 1px solid black; padding: 5px;">Mileage</th>
                </tr>
            </thead>
            
            <?php while(($row = fgetcsv($fp)) !== false): ?>
                <tr>
                    <form action="car_update.php" method="POST">
                        <td style="border: 1px solid black; padding: 5px;"><?= $row[0] ?></td>
                        
                        <input type="hidden" name="chassis" value="<?= $row[0] ?>">
                        
                        <td style="border: 1px solid black; padding: 5px;">
                            <input type="text" name="model" value="<?= $row[1] ?>">
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            <input type="text" name="brand" value="<?= $row[2] ?>">
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            <input type="number" name="year" value="<?= $row[3] ?>">
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            <input type="text" name="color" value="<?= $row[4] ?>">
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            <input type="number" name="mileage" value="<?= $row[5] ?>">
                        </td>
                        <td>
                            <abbr style="text-decoration: none;" title="Save changes">
                                <button style="background-color: rgba(0, 0, 0, 0); border: none; color: blue; font: bold; cursor: pointer;">&#128190;</button>
                            </abbr>
                        </td>
                    </form>
                    <td>
                        <abbr style="text-decoration: none;" title="Delete car">
                            <a style="text-decoration: none; color: red; font-weight: bold; padding: 5px;" href="car_delete.php?chassis=<?= $row[0] ?>">&cross;</a>
                        </abbr>
                    </td>
                </tr>
            <?php endwhile ?>
        </table>
    <?php endif ?>
</body>
</html>