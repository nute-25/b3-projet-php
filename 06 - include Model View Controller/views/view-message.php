
<h1>c'est incroyable, on a appell� le controller et il a *inclus* la view ! </h1>
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