<?php
require_once("./inc/nav.php");
require_once('../models/bookModel.php');
$listBook = Book::listBook();

?>

<div class="d-flex w-50 m-auto flex-wrap">
    <?php foreach ($listBook as $book) { ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title fs-6">
                    <?= $book["title"]; ?>
                </h5>
                <p class="card-text">
                    <?= $book["author"]; ?>
                </p>
                <p class="card-text">
                    <?= $book["publication"]; ?>
                </p>
                <?php if ($book["state"] == "available") { ?>
                    <a href="./models/action.php?book=<?= $book['id_book']; ?>">Borrow This Book</a>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>