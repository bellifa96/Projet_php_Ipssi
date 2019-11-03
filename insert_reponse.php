<?php 
session_start();

if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
    		//var_dump($_SESSION['id']);

}
else{
	header('Location:index.php');
  	exit;
}
// on teste si le formulaire a été soumis

if (isset ($_POST['go']) && $_POST['go']=='Poster') {
	// on teste le contenu de la variable $auteur
	if (!isset($_POST['message']) || !isset($_GET['numero_du_sujet'])) {
	$erreur = 'Les variables nécessaires au script ne sont pas définies.';
	}
	else {
	if (empty($_POST['message']) || empty($_GET['numero_du_sujet'])) {
		$erreur = 'Au moins un des champs est vide.';
	}
	// on commencee l'insertion dans la base
	else {
		echo $_GET['numero_du_sujet'];
		// on se connecte à notre base de données
		include_once("bddc.php");

		// on recupere la date de l'instant présent
		$id_post=$_GET['numero_du_sujet'];

		$user = $_SESSION['id'];
		//var_dump($_SESSION['id']);
		// préparation de la requête d'insertion (table forum_reponses)
		$sql =$bdd->prepare('INSERT INTO comments(content,idPost,idCUser) VALUES(:content, :idPost,:id)');
		$sql->execute(array('content'=>$_POST['message'],'idPost'=>$id_post,'id'=>$user));
		// préparation de la requête de modification de la date de la dernière réponse postée dans la table posts
		header('Location:lire_sujet.php?id_sujet_a_lire='.$_GET['numero_du_sujet']);

		// on termine le script courant
		exit;
	}
	}
}
?>

<html>
<head>
<title>Insertion d'une nouvelle réponse</title>
</head>

<body>

<!-- on fait pointer le formulaire vers la page traitant les données -->
<form action="insert_reponse.php?numero_du_sujet=<?php echo $_GET['numero_du_sujet']; ?>" method="post">
<table>
<tr><td>
[b]Message :[/b]
</td><td>
<textarea name="message" cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
</td></tr><tr><td><td align="right">
<input type="submit" name="go" value="Poster">
</td></tr></table>
</form>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</body>
</html>
