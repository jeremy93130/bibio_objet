<?php
require_once('../models/userModel.php');
$borrowList = User::borrow($_COOKIE["id_user"]); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Historic</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID:</th>
                <th>Title:</th>
                <th>Author:</th>
                <th>Start Date :</th>
                <th>End Date :</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($borrowList as $list) { ?>
                <tr>
                    <td>
                        <?= $list["id_borrow"];?>
                    </td>
                    <td>
                        <?= $list["title"]; ?>
                    </td>
                    <td>
                        <?= $list["author"]; ?>
                    </td>
                    <td>
                        <?= $list["start_date"];?>
                    </td>
                    <td>
                        <?= $list["end_date"]; ?>
                    </td>
                    <?php if ($list["end_date"] == null) { ?>
                        <td><a href="./models/action.php?borrow=<?= $list["id_borrow"]; ?>&bookId=<?= $list["book_id"]; ?>">Rendre
                                le livre</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>