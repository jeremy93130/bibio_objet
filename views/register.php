<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/biblio_objet/views/assets/css/style.css">
    <title>register</title>
</head>

<body>
    <form action="./models/action.php" method="post">
        <div>
            <label for="name">Name :</label>
            <input type="text" name="name">
            <label for="email">Email :</label>
            <input type="email" name="email">
            <label for="password">Password :</label>
            <input type="password" name="password">
        </div>
        <button type='submit' name="submit">Submit Form</button>
    </form>
</body>

</html>