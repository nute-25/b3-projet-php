<h1>si aucune action n'est reconnue dans le $_GET['action'] le controller *inclus* la view par defaut ! </h1>
<p>
    par contre si on lui envoie "?action=form" il va afficher le formulaire
</p>
<a href="?action=form"> appeller le controller courant avec "?action=form"</a>

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