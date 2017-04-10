<?php

$change_password_valid=false;
$login= htmlspecialchars($_SESSION['user']->login);

    
// code de traitement du formulaire : 
    
if(isset($_POST["up0"]) && $_POST["up0"] != "" &&
   isset($_POST["up1"]) && $_POST["up1"] != "" &&
   isset($_POST["up2"]) && $_POST["up2"] != "") {  
        
  // code de traitement, à écrire maintenant
  
  if(($_POST["up2"] == $_POST["up1"]) && (Utilisateur::getUtilisateur($dbh, $login) != NULL) && (Utilisateur::testerMdp($dbh,$login,$_POST["up0"])) ){
      
      $new_password= sha1($_POST['up1']);
      Utilisateur::changeMdp($dbh, $login, $new_password);
      $change_password_valid = true;
      echo $change_password_valid;
      
  }
 else {
    echo'erreur';
  }
}

    

if (!$change_password_valid) {
    echo <<<CHAINE_DE_FIN
    <div class="container-fluid cadre_transparent row col-md-8 col-md-offset-2">
    <div>
        <p> $login, voulez vous changer de mot de passe? </p>
    </di>
    <form action="?page=changePassword" method="post"
          oninput="up2.setCustomValidity(up2.value != up1.value ? 'Les mots de passe diffèrent.' : '')">
        <div class="form-group">
            <label for="password0">Password:</label>
            <input id="password0" type="password" required name="up0" class="form-control">
        </div>      
        <div class="form-group">
            <label for="password1">New password:</label>
            <input id="password1" type="password" required name="up1" class="form-control">
        </div>
        <div class="form-group">
            <label for="password2">Confirm password:</label>
            <input id="password2" type="password" name="up2" class="form-control">
        </div>
        <button type="submit" class="btn btn-default">change password</button>
    </form>
</div>   
CHAINE_DE_FIN;
}else{
    echo 'Vous avez changé de mot de passe ';
}
