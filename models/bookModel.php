<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/biblio_objet/models/database.php');
class Book
{
    // Methode pour enregistrer un nouveau livre
    public static function addBook($title, $author, $publication)
    {
        // Connection base de données:
        $db = Database::dbConnect();

        // Préparation de la requête :
        $request = $db->prepare('INSERT INTO books (title,author,publication) VALUES (?,?,?)');

        // Execution de la requête :
        try {
            $request->execute(array($title, $author, $publication));
            header('Location: http://localhost/biblio_objet/views/list_book.php');
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    // Methode pour récuperer la liste des livres :
    public static function listBook()
    {
        // Connexion à la base de données 
        $db = Database::dbConnect();

        // Préparation de la requête :
        $request = $db->prepare('SELECT * FROM books');

        // Executer la requête :
        try {
            $request->execute();
            // Récuperer le resultat dans un tableau
            $listBook = $request->fetchAll(PDO::FETCH_ASSOC);
            return $listBook;
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    // Methode pour emprunter un livre :
    public static function borrowBook($user, $book)
    {
        // Connexion à la base de données :
        $db = Database::dbConnect();

        // Préparation de la requête 
        $request = $db->prepare('INSERT INTO borrows (start_date,user_id,book_id) VALUES (NOW(),?,?)');

        // Execution de la requête 
        try {
            $request->execute(array($user, $book));
            // Requête pour mettre à jour le statut du livre 
            $request = $db->prepare('UPDATE books SET state = ? WHERE id_book = ?');
            try {
                $request->execute(array("unavailable", $book));
                header('Location: http://localhost/biblio_objet/views/historic.php');
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        } catch (PDOException $error) {
            echo $error->getMessage();
        }


    }
    public static function returnBook($borrow,$bookId)
    {
        // Connexion à la base de données :
        $db = Database::dbConnect();

        // Préparation de la requête 
        $request = $db->prepare('UPDATE borrows SET end_date = NOW() WHERE id_borrow = ? ');

        // Execution de la requête 
        try {
            $request->execute(array($borrow));
            // Requête pour mettre à jour le statut du livre 
            $request = $db->prepare('UPDATE books SET state = ? WHERE id_book = ?');
            try {
                $request->execute(array("available", $bookId));
                header('Location: http://localhost/biblio_objet/views/historic.php');
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        } catch (PDOException $error) {
            echo $error->getMessage();
        }


    }
}