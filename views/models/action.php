<?php
session_start();
require_once('../../models/userModel.php');

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