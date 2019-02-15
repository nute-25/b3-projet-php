<?php
// on inclus un header de base
include('views/header.php');
?>



<h1>debug</h1>
chemin courant :
<?php
echo realpath(dirname(__FILE__));
?>

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

<h1>L'upload et la sauvegarde serveur</h1>

<p>
    quand un fichier est envoyé au serveur, php le stocke dans un espace temporaire avec un nom pourri.
</p>

<p>
    ce qu'il faut faire a ce moment c'est le deplacer de cet espace temporaire vers un espace final et lui redonner un
    nom normal
</p>

<p>
    ca tombe bien, le nom d'origine du fichier est fourni dans le tableau $_FILES avec l'index $_FILES['nom du champ
    fichier']['name']
</p>

<p>
    l'emplacement et le nom temporaire que php lui a filé lors de l'upload c'est aussi dans le tableau $_FILES avec
    l'index $_FILES['nom du champ fichier']['tmp_name']
</p>

<p>
    et y'a une function php pour deplacer les fichiers, ca s'appelle move_uploaded_file(chemin complet source, chemin
    complet destination)
</p>
<p>
    le chemin de destination c'est [un chemin "sur le disque"+ nom de fichier], la par exemple on va dire que le chemin ca sera [repertoire courant +'/uploads/'+ nom de fichier d'origine]
</p>

<?php
    // si il y a un fichier envoyé on le stocke dans repertoire courant + nom de fichier
    if (isset($_FILES['fichier']) && !empty($_FILES['fichier']['name'])){

        $tmp_name = $_FILES['fichier']['tmp_name'];

        $current_dir = realpath(dirname(__FILE__));
        $final_name = $current_dir .'/uploads/'. $_FILES['fichier']['name'];
        if(move_uploaded_file($tmp_name, $final_name)){
            echo ('<hr/>fichier uploadé TMTC<hr/>');
        }
    }
?>

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

