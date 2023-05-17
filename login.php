<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h3>Login</h3>

    <?php if (isset($_GET['err'])): ?>
        <p style="color: red;">
            <?php echo $_GET['err'] ?>
        </p>
    <?php endif ?>

    <form action="auth.php" method="POST" style="display: flex; flex-direction: column; width: 30%;">
        Email: <input style="margin-bottom: 2%" type="text" name="email" required>
        Password: <input style="margin-bottom: 2%" type="password" name="passwd" required>
        <button style="background-color: lightgreen; cursor: pointer;">Login</button>
    </form>
</body>
</html>