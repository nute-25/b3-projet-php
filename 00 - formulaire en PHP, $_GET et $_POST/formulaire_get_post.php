<html>
<head>
    <meta charset="UTF-8">
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
var_dump($_POST);
?>
    </pre>
<hr/>


<?php
// test simple pour verifier que le champ $_POST['pouet'] existe ET (&&) contient une valeur
// verfier qu'il existe ca permet de ne pas avoir le message au premier chargement de page
if (isset($_POST['pouet']) && empty($_POST['pouet'])) {
    echo 'HEY OH BATARD T\'AS OUBLIé le champ pouet !';
}
?>

<h1>formulaire</h1>

<p>
    en PHP, il existe 2 super globales $_GET et $_POST qui permettent de recup' les données d'un formulaire dans un
    tableau indexé (i.e $_GET['toto'] recup la valeur d'un input avec name="toto")
</p>

<p>
    pour choisir d'utiliser l'un ou l'autre on utilise la "method" d'un formulaire &lt;form method="post" action=""&gt;
</p>

<p>
    $_GET est special dans ce sens ou il utilise aussi ce qu'on appelle les QUERY STRING, i.e
    http://prout.com?clef=valeur retourne "valeur" si je demande le contenu de $_GET['clef']
</p>

<p>
    une particularité de $_GET et $_POST est qu'ils n'existent que sur la page que receptionne les données du
    formulaire, des qu'on *change* de page - via une redirection header('Location: xxx') on perd les données.
</p>

<form method="post" action="">
    <fieldset>
        <label for="pouet">pouet</label>
        <?php
        $maValeurPouet = '';
        if (!empty($_POST['pouet'])){
            $maValeurPouet = $_POST['pouet'];
        }
        ?>
        <input type="text" name="pouet" value="<?php echo $maValeurPouet ?>">


        <input type="text" name="pouet" value="<?php echo !empty($_POST['pouet']) ? ($_POST['pouet']) : '' ?>">
        Si le champ $_POST['pouet'] est non vide on affiche sa valeur dans l'attribut "value", sinon on affiche string
        vide
    </fieldset>
    <fieldset>
        <label for="machin">machin</label>
        <input type="text" name="machin" value="<?= !empty($_POST['machin']) ? ($_POST['machin']) : '' ?>">
        "&lt;?=" est un shortcut pour "&lt;?php echo"
    </fieldset>
    <fieldset>
        <label for="truc">truc</label>
        <input type="text" name="truc" value="<?= !empty($_POST['truc']) ? ($_POST['truc']) : '' ?>">
        opérateur TERNAIRE : (condition) ? si vrai : si faux

    </fieldset>
    <input type="submit">
</form>


</body>
</html>