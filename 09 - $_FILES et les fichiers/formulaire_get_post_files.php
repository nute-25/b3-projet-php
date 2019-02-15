<?php
// on inclus un header de base
include('views/header.php');
?>



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
<pre>
<?php
echo '$_FILES' . "\r\n";
print_r($_FILES);
?>
    </pre>
<hr/>


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

<h1>Les fichiers</h1>
<p>
    l'upload c'est un cas particulier parce qu'on envoie pas de "texte" mais un/des fichiers
</p>
<p>
    pour commencer il faut indiquer dans le formulaire qu'on va envoyer des données dans ces deux formats : texte et
    fichier, pour ca on indique enctype="multipart/form-data" dans le tag du formulaire
</p>
<p>
    la grosse blague c'est que les données texte seront toujours trouvables dans le $_POST... le fichier sera lui dans
    une autre super globale : $_FILES,...
</p>

<form method="post" action="" enctype="multipart/form-data">
    <fieldset>
        <label for="texte">texte</label>
        <input type="text" name="texte" value="<?php echo !empty($_POST['texte']) ? ($_POST['texte']) : '' ?>">

    </fieldset>

    <fieldset>
        <label for="fichier">fichier</label>
        <input type="file" name="fichier">

    </fieldset>
    <input type="submit">
</form>


<?php
// on inclus un footer de base
include('views/footer.php');
?>
