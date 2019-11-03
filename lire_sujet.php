<html>
<head>
<title>Lecture d'un sujet</title>
<?php 
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
}
?>
</head>
<!--***************CSS****************-->
<style type="text/css">
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<body>
	<!--***************php****************-->

<?php
if (!isset($_GET['id_sujet_a_lire'])) {
	echo 'Sujet non défini.';
}
else {
?>
	<table id="customers"><tr>
	<td>
	Titre
	</td><td>
	Sujet
	</td></tr>
<?php
	// on se connecte à notre base de données
	include_once("../Model/bddc.php");
	// on prépare notre requête // on recupere le contenu et le titre de l'id=id
	$id = $_GET['id_sujet_a_lire'];
	$sql = $bdd->prepare('SELECT posts.content,title FROM posts where posts.id = :id');
	$sql->execute(array('id'=>$id));
	$array_post = $sql->fetchALL();
	// on prépare la requête // on recupere les commentaires et le username 
	$sql_c = $bdd->prepare('SELECT comments.content,username FROM comments inner join posts ON posts.id = comments.idPost inner join users ON users.id=comments.idCUser where idPost = :id');
	$sql_c->execute(array(':id'=>$id));
	$array_comment = $sql_c->fetchALL();

	foreach($array_post as $key => $data) {
	
		// on affiche les résultats
		echo '<tr>';
		echo '<td>';

		echo htmlentities(trim($data['title']));
		echo '<br/>';
		echo '</td><td>';

		// on affiche le message
		echo nl2br(htmlentities(trim($data['content'])));
		echo '</td></tr>';
	}
?>
	<!-- on ferme notre table html -->
	</table>
	<img style="width: 100%;height:100px; " src="separe.png">
	<table id="customers"><tr>
	<td>
	Réponse
	</td><td>
	Utilisateur	
	</td>
</tr>
	<?php 
		foreach($array_comment as $key => $data) {
	
		// on affiche les résultats
		echo '<tr>';
		echo '<td>';

		// on affiche le message
		echo nl2br(htmlentities(trim($data['content'])));
		echo '</td><td>';
		// on affiche l'auteur du message
		echo nl2br(htmlentities(trim($data['username'])));

		echo '</td></tr>';
	}
	?>
</table>
	<br /><br />
	<!-- on insère un lien qui nous permettra de rajouter des réponses à ce sujet -->
	<a href="./insert_reponse.php?numero_du_sujet=<?php echo $_GET['id_sujet_a_lire']; ?>">Répondre</a>
	<?php
	}

?>
<br /><br />
<a href="./index.php">Retour à l'accueil</a>

</body>
</html>