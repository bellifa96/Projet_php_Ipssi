<?php 
include_once('../Model/bddc.php');
$pseudo = $_POST['id'];
//$req=$bdd->prepare('SELECT id,username, password FROM users WHERE username = :pseudo');
//$req->execute(array('pseudo' => $pseudo));
$resultat = get_connexion($pseudo);
//var_dump($resultat['password']);
//$isPasswordCorrect = if(md5($_POST['pwd']), $resultat['password']));
//var_dump($isPasswordCorrect);
if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    if (md5($_POST['pwd']) === $resultat['password']) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $pseudo;
        echo 'Vous êtes connecté !';
        //echo $_SESSION['pseudo'];
        header('location: ../index.php');
        exit;
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
} 


?>


 <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <title> Cnnexion </title>
        <body>

        <div class="container">
            <div class="form-row col-md-6" style="padding: 20px ; margin-top: 2%; margin-left: 26%; margin-right: 26%; margin-bottom: 10% ;  background-color:hsla(240, 20%, 95%, 0.5)">
                <div class="form-row " >
                <i>
                    <form method="post" action="connexion.php">
                        <div class="form-row" >

                            <div class="form-group col-md-12">
                              <span class="input-group-addon "> <label for="id"> <i class="glyphicon glyphicon-star"></i></label> </span>
                              <input type="text" class="form-control" id="id" name="id" placeholder="Veuillez saisir votre pseudo svp !">
                            </div>
                            <div class="form-group col-md-12">
                              <span class="input-group-addon "> <label for="pwd"> <i class="glyphicon glyphicon-lock"></i></label> </span>
                              <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Veuillez saisir votre mot de passe svp !">
                            </div>
                
                
                        </div>
                </div>
                <div class="form-row" >
                    
                  <button type="submit" class="btn btn-primary " style="margin-left: 40%"> Se connecter</button>
                </div>
        </form>
    </div>
</div>


</i>
