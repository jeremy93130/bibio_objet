<?php

class Database
{
    // Une méthode static est une méthode qu'on peut éxécuter sans instancier la classe dans laquelle elle est créee 
    public static function dbConnect()
    {
        $connexion = null;
        try {
            $connexion = new PDO("mysql:host=localhost;dbname=biblio_db", "root", "");
        } catch (PDOException $error) {
            $connexion = $error->getMessage();
        }
        return $connexion;
    }
}