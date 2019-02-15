<?php
// connection base mysql
$dbhost = 'localhost'; // machine, la machine locale s'appelle par convention "localhost"
$dbname = 'winners'; // nom de la base de données
$dbuser = 'root'; // nom d'utilisateur base de données
$dbpassword = ''; // mot de passe base de données

// on se connecte avec les acces,  IL FAUT QUE LA BASE EXISTE POUR MANIPULER
$dbh = new PDO(
    'mysql:host='. $dbhost .';dbname='. $dbname,
    $dbuser,
    $dbpassword
);
?>