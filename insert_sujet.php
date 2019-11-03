<?php
// on teste si le formulaire a été soumis
session_start();

if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
 if (isset ($_POST['send']) && $_POST['send']=='Poster') {
  // on teste la déclaration de nos variables
  if (!isset($_POST['sujet']) || !isset($_POST['titre']) || !isset($_POST['Categories'])) {
  $erreur = 'Les variables nécessaires au script ne sont pas définies.';
  }
  else {
  // on teste si les variables ne sont pas vides
  if (empty($_POST['sujet']) || empty($_POST['titre']) || empty($_POST['Categories'])) {
    $erreur = 'Au moins un des champs est vide.';
  }

  // si tout est bon, on peut commencer l'insertion dans la base
  else {
    // on se connecte à notre base
    include_once("../Model/bddc.php");
    set_category($_POST['Categories']);

    if (get_category($_POST['Categories'])){
      $idCategory = get_category($_POST['Categories']);

      $a=$_SESSION['id'];

      $sql = $bdd->prepare('INSERT INTO posts(title,content,idCategory,idUser) VALUES(:title, :content, :idCategory, :idUser)');
      $sql->execute(array('title'=>$_POST['titre'],'content'=>$_POST['sujet'],'idCategory'=>$idCategory,'idUser'=>$a));
    

  }


    // on redirige vers la page d'accueil
    header('Location: ../index.php');

    // on termine le script courant
    exit;
  }
  }
}
?>
<html>
<head>
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  margin-top: 5%; 
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>

<h2 style="color:#5F9EA0;text-align: center;margin-top:5%; ">ECRIRE UN SUJET </h2>

<div class="container">
  <form action="insert_sujet.php" method="post">
  <div class="row">
    <div class="col-25">
      <label for="fname">Titre du sujet</label>
    </div>
    <div class="col-75">
      <input type="text" id="titre" name="titre" placeholder="Titre...">
    </div>
  </div>
    <div class="col-25">
      <label for="country">Categories</label>
    </div>
    <div class="col-75">
      <select id="Categories" name="Categories">
        <option value="PHP">PHP</option>
        <option value="JAVA">JAVA</option>
        <option value="SQL">SQL</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="subject">Sujet</label>
    </div>
    <div class="col-75">
      <textarea id="sujet" name="sujet" placeholder="Posez votre question.." style="height:200px"></textarea>
    </div>
  </div>
  <div class="row">
    <input type="submit" name="send" value="Poster">
  </div>
  </form>
</div>

<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</body>
<?php   
}
else{
  header('Location:index.php');
  exit;

}
