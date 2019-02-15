<?php
//demarrage session
session_start();

$messages = [];
// si il y a des messages en session on les prend et on les mets dans une variable cr�ee pour l'occasion
if (isset($_SESSION['messages'])) {
    $messages = $_SESSION['messages'];
    $_SESSION['messages'] = [];
}

?>
<h1>c'est incroyable, on a appellé le controller et il a *redirigé* vers la view ! </h1>
<ul>
<?php    
    // pour chacun des messages on les affiche
    for ($i = 0; $i < count($messages); $i++) {
?>
        <li><?= $messages[$i]['id'] ?> / <?= $messages[$i]['name'] ?></li>
<?php
    }
?>
</ul>