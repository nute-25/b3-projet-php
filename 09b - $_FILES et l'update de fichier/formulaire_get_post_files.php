<?php

// connection base mysql
// on a deplace le code connexion dbb suivant dans un fichier includes/database.inc.php
// l'inclure fait que php fait comme si il etait ecrit a cet endroit
// du coup la variable $dbh qui est declarée dans includes/database.inc.php reste accessible ici.
include('includes/database.inc.php');


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
    le chemin de destination c'est [un chemin "sur le disque"+ nom de fichier], la par exemple on va dire que le chemin
    ca sera [repertoire courant +'/uploads/'+ nom de fichier d'origine]
</p>

<h1>La mise a jour d'un enregistrement contenant un fichier</h1>

<p>
    bon alors la c'est la merde
    , un des gros probleme avec les fichiers c'est qu'il est impossible de preremplir un champ input type="file"
</p>

<p>si on soumet un formulaire et qu'il y a une erreur en retour l'utilisateur doit RESELECTIONNER son fichier, c'est
    naze...</p>
<p>par defaut, sans ajax (ou flash hahah) on peut pas aller plus loin que ce qui suit </p>
<p>
    je sais ca pue du cul...
<ul>
    <li>si on veut modifier un enregistrement existant il faut se rappeller que seul "le nom de fichier" est en base, le
        "fichier binaire" quand a lui est dans un repertoire
    </li>
    <li>si on selectionne un fichier pour remplacer l'ancien il n'y a pas de souci, on uploade l'image et stocke son nom
        en base
    </li>
    <li>si on NE selectionne PAS de fichier pour remplacer l'ancien il faut alors traiter le cas ou on renvoie le "nom
        du fichier" deja présent dans la base
    </li>
</ul>
</p>

<p>
    du coup deja on va commencer par afficher un lien / image vers le fichier si on est en mode edition histoire de
    prevenir l'utilisateur qu'un fichier est deja referencé.
</p>
<p>
    ensuite, si un fichier est deja referencé, on va mettre des inputs cachés (comme on a fait pour le champ "id") pour
    preremplir et se faciliter le taff.
</p>

<p>
    <em>
        la grosse feinte c'est que le champ contenant le "nom de fichier" prérempli (du texte) sera envoyé dans le
        $_POST, alors que le fichier a uploader sera dans le $_FILES (un fichier) !!!
    </em>
</p>
<p>
    <em>
        du coup il suffira de tester si le $_FILES['nom de champ'] est rempli, s'il l'est pas on prendra le $_POST['nom
        de champ']
    </em>
</p>










<?php

if (isset($_GET['action']) && ($_GET['action'] == "form") && isset($_GET['id'])) {
    /*
     * si on a un id de fourni
    * on charge l'element depuis la base de donnée
    */
    // recherche dans la table message les elements avec id = "$_GET['id']"
    $sql = "select * from message where id =:id limit 1";
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(
        ':id' => $_GET['id']
    ));
    $message = $sth -> fetch();
    // on met le contenu de l'element demandé dans $postdata
    $postdata = $message;

}

if (isset($_GET['action']) && ($_GET['action'] == "save")) {

    /*
    * on sauvegarde l'element dans la base de donnée
    */

// par defaut on va considerer que le "nom de fichier" c'est celui fourni en $_POST
    $file_name = $_POST['fichier'];

// si il y a un fichier envoyé on le stocke dans repertoire courant + nom de fichier
    if (isset($_FILES['fichier']) && !empty($_FILES['fichier']['name'])) {

        $tmp_name = $_FILES['fichier']['tmp_name'];

        $current_dir = realpath(dirname(__FILE__));



        $final_name = $current_dir . '/uploads/' . $_FILES['fichier']['name'];
        if (move_uploaded_file($tmp_name, $final_name)) {
            // si le fichier est uploade, on va considerer que le "nom de fichier" c'est celui fourni en $_FILES
            $file_name = $_FILES['fichier']['name'];
            echo('<hr/>fichier uploadé TMTC<hr/>');
        }
    }

    /*
     *  ON TRAITE LE CAS OU C'EST un Update et pas une Creation
     * pour ca on ajoute un bout de code SQL qui permet de gerer ce cas
     * sur le debut de la requete on a rajouté l'alias :id qui correspond au $_POST['id'] ( et pas au $_GET['id'] )
     * si un id est fourni en $_POST c'est tres certainement un update.
     */
    /* syntaxe avec preparedStatements */
    $sql = "insert into message (id, message, fichier) values(:id,  :message, :fichier)";
    $sql .= " on duplicate key update message=:message, fichier=:fichier";


    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(
        ':id' => $_POST['id'],
        ':message' => $_POST['message'],
        ':fichier' => $file_name
    ));

}
?>



<?php
//requete qui doit retourner des resultats pour les editer
$results = $dbh->query("select * from message");
// recupere les messages dans le connecteur
$messages = $results->fetchAll();

for ($i = 0; $i < count($messages); $i++) {
    ?>
    <article>
        <a href="?action=form&id=<?= $messages[$i]['id'] ?>"><?= $messages[$i]['id'] ?> / <?= $messages[$i]['message'] ?> / <?= $messages[$i]['fichier'] ?></a>

    </article>
<?php
}
?>





<form method="post" action="?action=save" enctype="multipart/form-data">
    <fieldset>
        <label for="id">id, en lecture seule,  normalement caché</label>
        <input type="text" name="id" readonly="readonly" value="<?php echo !empty($postdata['id']) ? ($postdata['id']) : '' ?>">

    </fieldset>
    <fieldset>
        <label for="name">message</label>
        <input type="text" name="message" value="<?php echo !empty($postdata['message']) ? ($postdata['message']) : '' ?>">

    </fieldset>

    <fieldset>
        <label for="fichier">fichier (fichier)</label>
        <input type="file" name="fichier">
    </fieldset>


    <fieldset>
        <label for="fichier">nom de fichier (texte), ce champ devrait etre caché</label>
        <input type="text" name="fichier"
               value="<?php echo !empty($postdata['fichier']) ? ($postdata['fichier']) : '' ?>">
        <?php
        if (!empty($postdata['fichier'])) {
            ?>
            <a href="<?php echo( 'uploads/'. $postdata['fichier'] ) ?>">lien vers le fichier</a>
        <?php
        }
        ?>
    </fieldset>


    <input type="submit">
</form>


<?php
// on inclus un footer de base
include('views/footer.php');
?>

