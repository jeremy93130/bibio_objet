<?php require_once('./inc/nav.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/assets/css/style.css">
    <title>addBook</title>
</head>

<body>
    <form action="./models/action.php" method="post">
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title">
            <label for="author">Author:</label>
            <input type="text" name="author">
            <label for="date">Publication date :</label>
            <input type="date" name="date">
        </div>
        <button type='submit' name="submitBook">Submit New Book</button>
    </form>
</body>

</html>