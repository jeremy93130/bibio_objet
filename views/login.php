<?php session_start();
require_once('./inc/nav.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Document</title>
</head>

<body>
    <form action="./models/action.php" method="post">
        <div>
            <label for="email">Enter Your Email :</label>
            <input type="email" name="email">
            <label for="password">Enter Your Password :</label>
            <input type="password" name="password">
        </div>
        <?php if (isset($_SESSION["error_message"])) { ?>
            <p>
                <?= $_SESSION["error_message"];
                ?>
            </p>
            <?php unset($_SESSION['error_message']);
        } ?>
        <button type='submit' name="submitLogin">Login</button>
    </form>
</body>

</html>