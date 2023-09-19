<?php
session_start();
require_once('../../models/userModel.php');
require_once('../../models/bookModel.php');

if (isset($_POST["submit"])) {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Hasher le mot de passe
    $mdpHash = password_hash($password, PASSWORD_DEFAULT);

    // Appeler la methode inscription user:
    User::register($name, $email, $mdpHash); // La méthode inscription étant statique donc on utilise le nom de la classe suivie de "::" ensuite le nom de la méthode qui est register()
}

if (isset($_POST["submitLogin"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Appeler la methode connexion user:
    User::connect($email, $password);

}

// Pour ajouter un livre
if (isset($_POST["submitBook"])) {
    $title = htmlspecialchars($_POST["title"]);
    $password = htmlspecialchars($_POST["author"]);
    $publishDate = htmlspecialchars($_POST["date"]);

    // Appeler la methode addBook :
    Book::addBook($title, $password, $publishDate);
}

// Pouyr emprunter un livre 
if (isset($_GET["book"])) {
    // Identifiant du livre à emprunter
    $book = $_GET["book"];
    // On récupère l'identifiant de l'utilisateur qui s'est connecté et qui souhaite emprunter ce livre
    $id_user = $_COOKIE["id_user"];
    // Appeler la methode borrowBook
    Book::borrowBook($id_user, $book);
}

// Pour rendre un livre
if (isset($_GET["borrow"])) {
    // Identifiant de l'emprunt du livre
    $borrow = $_GET["borrow"];
    // Appeler la methode returnBook
    $bookId = $_GET["bookId"];
    Book::returnBook($borrow, $book_id);
}