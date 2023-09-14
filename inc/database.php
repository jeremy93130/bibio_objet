<?php

function dbConnect()
{
    $db = null;
    try {
        $db = new PDO('mysql:host=localhost;dbname=biblio', "root", "");
    } catch (PDOException $error) {
        $error->getMessage();
    }
    return $db;
}