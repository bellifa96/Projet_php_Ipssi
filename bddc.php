<?php
$user="useer";
$pwd="1102";

try {
	 $bdd = new PDO('mysql:host=localhost;dbname=testt;port=3306',$user,$pwd) or null;

}
catch (Exception $e) {
        die('Erreur : ' . $e->getMessage().PHP_EOL);
}

function  get_sujet($id){
	$user="useer";
	$pwd="1102";
	$bdd = new PDO('mysql:host=localhost;dbname=testt;port=3306',$user,$pwd) or null;
	$sql = $bdd->prepare('SELECT posts.content,title FROM posts where posts.id = :id');
	$sql->execute(array('id'=>$id));
	return $sql->fetchALL();
}

function get_comments($id){
	$user="useer";
	$pwd="1102";
	$bdd = new PDO('mysql:host=localhost;dbname=testt;port=3306',$user,$pwd) or null;
	$sql_c = $bdd->prepare('SELECT comments.content,username FROM comments inner join posts ON posts.id = comments.idPost inner join users ON users.id=comments.idCUser where idPost = :id');
	$sql_c->execute(array(':id'=>$id));
	return $sql_c->fetchALL();
}

function get_connexion($pseudo){
	$user="useer";
	$pwd="1102";
	$bdd = new PDO('mysql:host=localhost;dbname=testt;port=3306',$user,$pwd) or null;
	$pseudo = $pseudo;
	$req=$bdd->prepare('SELECT id,username, password FROM users WHERE username = :pseudo');
	$req->execute(array('pseudo' => $pseudo));
	return $req->fetch();

}
function set_category(){
	$user="useer";
	$pwd="1102";
	$bdd = new PDO('mysql:host=localhost;dbname=testt;port=3306',$user,$pwd) or null;
	$sql_c = $bdd->prepare('INSERT INTO categories(name) VALUES(:name)');
	$sql_c->execute(array('name'=>$_POST['Categories']));

}
function get_category($var){
	$user="useer";
	$pwd="1102";
	$bdd = new PDO('mysql:host=localhost;dbname=testt;port=3306',$user,$pwd) or null;
	$sql_s = $bdd->prepare('select id from categories where name= :name');
	$sql_s->execute(array('name'=>$var));
    $res=$sql_s->fetchAll();
	foreach ($res as $key => $value) {
    $idCategory = $value['id'];
      
    }
    return $idCategory;
}
?>