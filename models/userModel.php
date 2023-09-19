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
                    setcookie("user_id", $user['id_user'], time() + 86400, "/", "localhost", false, true);
                    setcookie("name", $user['name'], time() + 86400, "/", "localhost", false, true);
                    setcookie("user_role", $user["role"], time() + 86400, "/", "localhost", false, true);
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

    // Méthode pour avoir l'historique des emprunts d'un utilisateur
    public static function borrow($idUser)
    {
        // Se connecter à la base de données 
        $db = Database::dbConnect();

        // Préparer la requête :
        $request = $db->prepare('SELECT id_borrow, state, start_date,end_date,user_id, book_id, id_book, title, author FROM borrows, books WHERE borrows.book_id = books.id_book');

        // Executer la requête :
        try {
            $request->execute();
            $borrow = $request->fetchAll(PDO::FETCH_ASSOC);
            return $borrow;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    // Méthode pour se désinscrire
    public static function deleteAccount()
    {

    }
}