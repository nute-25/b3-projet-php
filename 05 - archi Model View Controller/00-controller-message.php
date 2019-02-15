<?php
//demarrage session des fois que
session_start();


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

//requete qui doit retourner des resultats
$results = $dbh->query("select * from message");
// recupere les messages dans le connecteur
$messages = $results->fetchAll();

// on met les valeurs en session avec la clef 'messages'
$_SESSION['messages'] = $messages;

// on *redirige* vers la VIEW
header('Location: AA-view-message.php');

?>






