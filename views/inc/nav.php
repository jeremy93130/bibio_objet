<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <a href="http://localhost/biblio_objet/views/home.php">Home</a>


        <?php if (isset($_COOKIE['user_role']) && $_COOKIE['user_role'] == "admin") { ?>
            <a href="http://localhost/biblio_objet/views/add_book.php">Add Book</a>
        <?php } else { ?>
            <a href="http://localhost/biblio_objet/views/historic.php">Borrow Historic</a>
        <?php } ?>
    </nav>

</body>

</html>