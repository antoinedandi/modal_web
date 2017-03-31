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
    <div class="container-fluid row col-md-8 col-md-offset-2">
    <form action="?page=inscription" method="post"
          oninput="up2.setCustomValidity(up2.value != up.value ? 'Les mots de passe diffèrent.' : '')">
        <div class="form-group">
            <label for="name">name:</label>
            <input id="name" type="text" required name="name" value="$name" class="form-control">
        </div>
        <div class="form-group">
            <label for="fisrt_name">first name:</label>
            <input id="first_name" type="text" required name="first_name" value="$first_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="login">login:</label>
            <input id="login" type="text" required name="login" value="$login" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">email:</label>
            <input id="email" type="email" required name="email" value="$email" class="form-control">
        </div>        
        <div class="form-group">
            <label for="password1">Password:</label>
            <input id="password1" type="password" required name="up" class="form-control">
        </div>
        <div class="form-group">
            <label for="password2">Confirm password:</label>
            <input id="password2" type="password" name="up2" class="form-control">
        </div>
        <button type="submit" class="btn btn-default">Create account</button>
    </form>
</div>   
CHAINE_DE_FIN;
}else{
    echo 'felicitation vous etes inscrits à Lotopub';
}

