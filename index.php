<html>
<head>
<title>Index de notre forum</title>
</head>
<body>
<style>
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
<?php 
session_start();

if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
    echo "<br><a href="."./View/insert_sujet.php".">Insérer un sujet</a>";
    echo "<br><a href="."./Controller/deconnexion.php".">Déconnexion</a>";

}
else{
	echo "<br><a href="."./Controller/connexion.php".">Se connecter</a>";
	echo "<br><a href="."./Controller/inscription.php".">S'inscrire</a>";
}
	
?>



<br/><br/>
<?php
include_once("../Model/bddc.php");
$sql = $bdd->prepare('SELECT posts.id,title,content,username,name from posts inner join users on posts.idUser=users.id inner join categories on posts.idCategory= categories.id;
');
$sql->execute();
$array = $sql->fetchALL();
$nb_sujets = count($array);
//var_dump($nb_sujets);


if ($nb_sujets == 0) {
	echo 'Aucun sujet';
}
else {
	?>
	<table id="customers"><tr>
	<td>
	Auteur
	</td><td>
	Titre
	</td><td>
	catégorie
	</td><td>
	Sujet
	</td></tr>

	<?php
	foreach ($array as $key => $data) {
		//var_dump($data);

	echo '<tr>';
	echo '<td>';
	echo htmlentities(trim($data['username']));
	echo '</td><td>';

	echo '<a href="./View/lire_sujet.php?id_sujet_a_lire='.$data['id'].'">' , htmlentities(trim($data['title'])) , '</a>';

	echo '</td><td>';
	echo htmlentities(trim($data['name']));
	echo '</td><td>';

	echo htmlentities(trim($data['content']));
	echo '</td>';
	}
	?>
	</td></tr></table>
	<?php
}
?>
</body>
</html>