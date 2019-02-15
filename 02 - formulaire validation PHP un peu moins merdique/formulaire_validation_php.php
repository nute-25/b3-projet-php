<?php

// test simple pour verifier que le champ $_POST['pouet'] existe ET (&&) contient une valeur
// verfier qu'il existe ca permet de ne pas avoir le message au premier chargement de page

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


// si il existe un champ "name" fourni dans le $_POST, c-a-d qu'un formulaire ient d'etre valid� ET qu'il n'y a aucune erreur
if(isset($_POST['name']) && count($errors) == 0){
	echo ('SUPER MEC/MEUF');
}

?>




<html>
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: Arial, Helvetica, Sans serif;
        }

        .errors {
            color: ff0000;
        }

        fieldset {
            border: 1px solid rgba(0, 0, 0, .125);
        }

        label {
            float: left;
            min-width: 33%;
            display: inline-block;
        }
    </style>
</head>

<body>
<h1>debug</h1>
    <pre>
<?php
echo '$_GET' . "\r\n";
print_r($_GET);
?>
    </pre>
<hr/>
    <pre>
<?php
echo '$_POST' . "\r\n";
print_r($_POST);
?>
    </pre>
<hr/>




<h1>formulaire de la win</h1>
<p>
	le formulaire va envoyer ses donn�es a la page courante, on verifie la validit� des champs en PHP et on remonte les erreurs dans le tableau $errors
</p>
<form method="post" action="">

    <div class="errors">
<?php
// initialisation controller
$errors["address"] = "";
$errors["name"] = "";
$errors["age"] = "";

// la in dit y'a une erreur
$errors["address"] .= "erreur gros";

foreach ($errors as $key=>$value){
    if(!empty($value)){
        echo($key .":". $value . "<br />");
    }
}

/*

$errors[] = "texte erreur";

				// si il y a des erreurs on les affiche.
        for ($i = 0; $i < count($errors); $i++) {
            echo($errors[$i] . "<br />");
        }
*/
?>
    </div>

    <fieldset>
        <label for="name">name</label>
        <input type="text" name="name" value="<?php echo !empty($_POST['name']) ? ($_POST['name']) : '' ?>">
    </fieldset>

    <fieldset>
        <label for="email">email</label>
        <input type="text" name="email" value="<?= !empty($_POST['email']) ? ($_POST['email']) : '' ?>">
    </fieldset>

    <fieldset>
        <label for="message">message</label>
                <textarea name="message">
                    <?= !empty($_POST['truc']) ? ($_POST['truc']) : '' ?>
                </textarea>
    </fieldset>

    <input type="submit">
</form>


</body>
</html>