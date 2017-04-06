<?php

$form_values_valid=false;

if (isset($_POST["name"])) $name = $_POST["name"];
    else $name = "";
if (isset($_POST["first_name"])) $first_name = $_POST["first_name"];
    else $first_name = "";
if (isset($_POST["login"])) $login = $_POST["login"];
    else $login = "";
if (isset($_POST["email"])) $email = $_POST["email"];
    else $email = "";
    
// code de traitement du formulaire : 
    
if(isset($_POST["name"]) && $_POST["name"] != "" &&
   isset($_POST["first_name"]) && $_POST["first_name"] != "" &&
   isset($_POST["login"]) && $_POST["login"] != "" &&
   isset($_POST["email"]) && $_POST["email"] != "" &&
   isset($_POST["up"]) && $_POST["up"] != "" &&
   isset($_POST["up2"]) && $_POST["up2"] != "") {  
        
  // code de traitement, à écrire maintenant
  // $dbh, $login, $mdp, $nom, $prenom, $naissance, $email
    
  if(($_POST["up2"] == $_POST["up"]) && (Utilisateur::insererUtilisateur($dbh, $_POST["login"], $_POST["up"], $_POST["name"], $_POST["first_name"], '1980-03-27', $_POST["email"])) ){
      $form_values_valid = true;
  }
}

    

if (!$form_values_valid) {
    echo <<<CHAINE_DE_FIN
    <div class="row col-md-8 col-md-offset-2 cadre_transparent">
    <h2>Formulaire d'inscription</h2>
    <form action="?page=inscription" method="post" id="inscription">
        <div class="form-group">
            <label for="name">Nom :</label>
            <input id="name" type="text" required name="name" value="$name" class="form-control"> 
            <p class="messageErreur" id="messageName" hidden>Tapez un nom valide</p>
        </div>
        <div class="form-group">
            <label for="first_name">Prénom :</label>
            <input id="first_name" type="text" required name="first_name" value="$first_name" class="form-control">
            <p class="messageErreur" id="messageFName" hidden>Tapez un prénom valide</p>
        </div>
        <div class="form-group">
            <label for="login">Login :</label>
            <input id="login" type="text" required name="login" value="$login" class="form-control">
            <p class="messageErreur" id="messageLogin" hidden>Tapez un login valide</p>
            <p class="messageErreur" id="loginVu" hidden>Ce login est déjà pris !</p>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input id="email" type="email" required name="email" value="$email" class="form-control">
            <p class="messageErreur" id="messageEmail" hidden>Tapez un email valide</p>
        </div>        
        <div class="form-group">
            <label for="password1">Mot de passe :</label>
            <input id="password1" type="password" required name="up" class="form-control">
            <p class="messageErreur" id="messagePass" hidden>Le mot de passe n'est pas assez fort</p>
        </div>
        <div class="progress">
            <div id="complexity-bar" class="progress-bar progress-bar-danger"  role="progressbar" style="width:0%">
            </div>
        </div>
        <div class="form-group">
            <label for="password2">Confirmez votre mot de passe :</label>
            <input id="password2" type="password" name="up2" class="form-control" disabled>
            <p class="messageErreur" id="messagePass2" hidden>Les mots de passe diffèrent</p>
        </div>
        <button type="submit" class="btn btn-info" id="create_user_btn" disabled>Créez votre compte !</button>
    </form>
</div>   
CHAINE_DE_FIN;
}else{
    echo <<<FIN
    <div class="row col-md-8 col-md-offset-2 cadre_transparent">
        <h1>Félicitations </h1>
        <p>Vous êtes bien inscrit à Lotopub</p>
        <p>Connectez vous dès maintenant pour profitez du jeu</p>
    </div>
FIN;
}
?>


