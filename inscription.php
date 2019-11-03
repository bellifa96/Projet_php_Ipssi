<?php
$show_form=1;
include_once(__DIR__."/bddc.php");


if(isset($_POST['id'],$_POST['pwd'])){
    if(empty($_POST['id'])){
        echo "Veuillez saisir un pseudo";
    }elseif(strlen($_POST['id'])>30){//
        echo "Votre Id est long";
    } elseif(empty($_POST['pwd'])){
        echo "Veuillez saisir le mot de passe";
    } 
   elseif (strlen($_POST['pwd']) < 8 ) {
        echo "Votre mot de passe doit contenir au moins 8 caractères";
    }
    elseif(mysqli_num_rows($bdd->query("SELECT * FROM users WHERE username='".$_POST['id']."'"))==1){
        echo "Ce pseudo est déjà utilisé.";
    } else {
        if(!$bdd->query("INSERT INTO users SET username='".htmlspecialchars($_POST['id'])."', password='".md5($_POST['pwd'])."'")==1){
        } else {
            echo "Vous êtes inscrit avec succès!";
            header('local:connexion.php');
            $show_form=0;
        }
    }
}
if($sow_form=1){
    ?>
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <title> inscription </title>
        <body>

        <div class="container">
            <div class="form-row col-md-6" style="padding: 20px ; margin-top: 2%; margin-left: 26%; margin-right: 26%; margin-bottom: 10% ;  background-color:hsla(240, 20%, 95%, 0.5)">
                <div class="form-row " >
                <i>
                    <form method="post" action="inscription.php">
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
                    
                  <button type="submit" class="btn btn-primary " style="margin-left: 40%"> S'inscrire </button>
                </div>
        </form>
    </div>
</div>


</i>

    <?php
}
?>