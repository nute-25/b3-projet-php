<?php
//demarrage session
session_start();

// mise en session de valeur
$_SESSION['ta_mere'] = "la molle";

?>

<html>
<body>


<h1>Mise en Session</h1>
<p>
	une superglobale tres spéciale en PHP, $_SESSION permet de stocker des données persistantes.
</p>
<p>
	a noter que pour pouvoir UTILISER $_SESSION en lecture ou en ecriture il faut le demander avant, ca se fait en appellant "session_start()"
</p>
<p>
	en faisant $_SESSION['clef'] = "valeur"; on stocke la valeur "valeur" dans le tableau de session avec l'index "clef"
</p>
<p>
	contrairement a $_POST et $_GET, les valeurs en $_SESSION restent meme quand on change de page !
</p>

<p>
	La par exemple dans cette page on met la valeur "la molle" dans la clef "ta_mere" de $_SESSION :
</p>
<code>
	$_SESSION['ta_mere'] = "la molle";
</code>

<p>
	si je demande a la page suivante la valeur de $_SESSION['ta_mere'] ca me la rend car ca l'a conservé.
</p>
<a href="02-session-get.php">autre page</a>

</body>
</html>