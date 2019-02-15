<?php

// connection base mysql
// on a deplace le code connexion dbb suivant dans un fichier includes/database.inc.php
// l'inclure fait que php fait comme si il etait ecrit a cet endroit
// du coup la variable $dbh qui est declarée dans includes/database.inc.php reste accessible ici.
include('includes/database.inc.php');

// on inclus un header de base
include('views/header.php');

//demarrage session parce que voila on en aura peut etre besoin
session_start();

/*
 *  le coeur du controller c'est de rediriger en fonction des demandes
 *  pour ce faire on va simplement verifier si il y a un demande dans le $_GET['action']
 * si il y en a une on l'utilise, sinon on met une action par defaut
 */

$nextAction = (isset($_GET['action'])?$_GET['action']:'');

if($nextAction == 'form'){
    /*
     * maintenant si un id est fourni on charge l'element dans $postdata
     */
    if (isset($_GET['id'])){
        // recherche dans la table message les elements avec id = "$_GET['id']"
        $sql = "select * from message where id =:id limit 1";
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(
            ':id' => $_GET['id']
        ));
        $message = $sth -> fetch();
        // mise en session du contenu de l'element demandé
        $postdata = $message;
    }

    include('views/form.php');
}else if ($nextAction == 'save'){
    $errors = [];

    // si name existe
    if (isset($_POST['name'])){
        if (empty($_POST['name'])) {
            $errors[] = 'champ name vide';
            // si name > 50 chars
        } else if (mb_strlen($_POST['name']) > 50) {
            $errors[] = 'champ name trop long (50max)';
        }
    }

    // si email existe
    if (isset($_POST['email'])) {
        if (empty($_POST['email'])) {
            $errors[] = 'champ email vide';
        } else if (mb_strlen($_POST['email']) > 150) {
            $errors[] = 'champ email trop long (150max)';
            // filter_var
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'champ email non-valide';
        }
    }

    // si message existe et que le champ est non vide, on utilise trim() pour enlever les espaces/tabs en debut et fin de texte
    if (isset($_POST['message']) && empty(trim($_POST['message']))) {
        $errors[] = 'champ message vide';
    }


    // si pas d'erreur on enregistre, va chercher les elements et on inclus la liste
    // si erreur on inclus le formulaire en lui remettant les données dans $postdata
    if(count($errors) == 0){
        echo ('YEAH ca a marché');

        /*
         * on sauvegarde l'element dans la base de donnée
         *
         */


        /*
         *  ON TRAITE LE CAS OU C'EST un Update et pas une Creation
         * pour ca on ajoute un bout de code SQL qui permet de gerer ce cas
         * sur le debut de la requete on a rajouté l'alias :id qui correspond au $_POST['id'] ( et pas au $_GET['id'] )
         * si un id est fourni en $_POST c'est tres certainement un update.
         */
        /* syntaxe avec preparedStatements */
        $sql = "insert into message (id, name, email, message) values(:id, :name, :email, :message)";
        $sql .= " on duplicate key update name=:name, email=:email, message=:message";


        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(
            ':id' => $_POST['id'],
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':message' => $_POST['message']
        ));





        //requete qui doit retourner des resultats
        $results = $dbh->query("select * from message");
        // recupere les messages dans le connecteur
        $messages = $results->fetchAll();
        // on *inclus*  la VIEW, du coup la variable $messages y sera directement accessible
        include('views/list.php');

    }else{
        echo ('NOPE, y\'a des erreurs');
        $postdata = $_POST;

        include('views/form.php');
    }
}else{
    //requete qui doit retourner des resultats
    $results = $dbh->query("select * from message");
    // recupere les messages dans le connecteur
    $messages = $results->fetchAll();
    // on *inclus*  la VIEW, du coup la variable $messages y sera directement accessible
    include('views/list.php');
}

// on inclus un footer de base
include('views/footer.php');