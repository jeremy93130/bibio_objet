<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/biblio_objet/models/database.php');

class User
{
    // Méthode pour s'inscrire
    public static function register($name, $email, $password)
    {
        // connexion à la base de donnée:
        $db = Database::dbConnect();
        // Préparation de la requête
        $request = $db->prepare('INSERT INTO users(name,email,password) VALUES (?,?,?)');
        // executer la requête 
        try {
            $request->execute(array($name, $email, $password));
            // Rediriger vers la page de connexion 
            header("Location: http://localhost/biblio_objet/login");
        } catch (PDOException $error) {
            $error->getMessage();
        }
    }
    // Méthode pour se connecter
    public static function connect($email, $password)
    {
        // Se connecter à la base de données
        $db = Database::dbConnect();

        // Préparer la requête
        $request = $db->prepare('SELECT * FROM users WHERE email=?');

        try {
            $request->execute(array($email));
            // Recuperer le resultat de la requête dans un tableau
            $user = $request->fetch(PDO::FETCH_ASSOC);
            // Verifier si le mot de passe est correct
            if (empty($user)) {
                header("location:" . $_SERVER['HTTP_REFERER']);
                $_SESSION["error_message"] = "Cet e-mail n'existe pas";
            } else {
                if (password_verify($password, $user["password"])) {
                    // Le mail est bon et le mot de passe est bon
                    setcookie("id_user", $user['id_user'], time() + 86400, "/", "http://localhost/biblio_objet", false, true);
                    setcookie("user_role", $user["role"], time() + 86400, "/", "http://localhost/biblio_objet", false, true);
                    header("Location: http://localhost/biblio_objet/views/list_book.php");
                } else {
                    header("location:" . $_SERVER['HTTP_REFERER']);
                    $_SESSION["error_message"] = "Mot de passe incorrect";
                }
            }
        } catch (PDOException $error) {
            $error->getMessage();
        }
    }
    // Méthode pour se déconnecter
    public static function disconnect()
    {
    }

    // Méthode pour emprunter un livre
    public static function borrow()
    {

    }

    // Méthode pour se désinscrire
    public static function deleteAccount()
    {

    }
}