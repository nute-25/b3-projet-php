<?php

// connection base mysql
// on a deplace le code connexion dbb suivant dans un fichier includes/database.inc.php
// l'inclure fait que php fait comme si il etait ecrit a cet endroit
// du coup la variable $dbh qui est declarée dans includes/database.inc.php reste accessible ici.
include('includes/database.inc.php');


//demarrage session parce que voila on en aura peut etre besoin
session_start();

/*
 *  le coeur du controller c'est de rediriger en fonction des demandes
 *  pour ce faire on va simplement verifier si il y a un demande dans le $_GET['action']
 * si il y en a une on l'utilise, sinon on met une action par defaut
 */

$nextAction = (isset($_GET['action'])?$_GET['action']:'');

if($nextAction == 'form'){
    include('views/form.php');
}else{
    //requete qui doit retourner des resultats
    $results = $dbh->query("select * from message");
    // recupere les messages dans le connecteur
    $messages = $results->fetchAll();
    // on *inclus*  la VIEW, du coup la variable $messages y sera directement accessible
    include('views/list.php');
}
