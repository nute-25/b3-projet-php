<?php

// connection base mysql
// on a deplace le code connexion dbb suivant dans un fichier includes/database.inc.php
// l'inclure fait que php fait comme si il etait ecrit a cet endroit
// du coup la variable $dbh qui est declarée dans includes/database.inc.php reste accessible ici.
include('includes/database.inc.php');

/*
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
*/


//requete qui doit retourner des resultats
$results = $dbh->query("select * from message");
// recupere les messages dans le connecteur
$messages = $results->fetchAll();

// on *inclus*  la VIEW, du coup la variable $messages y sera directement accessible
// pas besoin de session donc :)
include('views/view-message.php');

?>






