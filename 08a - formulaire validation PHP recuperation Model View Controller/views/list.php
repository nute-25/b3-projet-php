<h1>si aucune action n'est reconnue dans le $_GET['action'] le controller *inclus* la view par defaut ! </h1>
<p>
    par contre si on lui envoie "?action=form" il va afficher le formulaire
</p>
<a href="?action=form"> appeller le controller courant avec "?action=form"</a>

<p>
    LA DIFFERENCE entre la 08 et la 08a :
    <ul>
        <li>- il suffit d'appeller ?action=form&id=XX pour preRemplir le formulaire avec l'element correspondant !, l'action "form" dans le controller est modifiée, si un id est fourni on le charge dans $postdata avant d'afficher le formulaire</li>
    <li>- on a rajouté un champ input name="id" dans le formulaire, </li>
    <li>- l'action "save" dans le controller est modifiée pour permettre la Création ou l'Update</li>
    </ul>
</p>
<p>
    la liste a été MAJ pour envoyer ces données dans le lien
</p>
<ul>
    <?php
    // pour chacun des messages on les affiche
    for ($i = 0; $i < count($messages); $i++) {
        ?>
        <li><a href="?action=form&id=<?= $messages[$i]['id'] ?>"> <?= $messages[$i]['id'] ?> / <?= $messages[$i]['name'] ?> </a></li>
    <?php
    }
    ?>
</ul>