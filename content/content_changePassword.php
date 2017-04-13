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

echo "<div class='container-fluid cadre_transparent row col-md-8 col-md-offset-2'>";
$login_secure= htmlspecialchars($login);
if (!$change_password_valid) {
    echo <<<CHAINE_DE_FIN
    
   
        <h2> $login_secure, voulez vous changer de mot de passe? </h2>
    
    <form action="?page=changePassword" method="post" id="changePassword"
          oninput="up2.setCustomValidity(up2.value != up1.value ? 'Les mots de passe diffèrent.' : '')">
        <div class="form-group">
            <label for="password0">Password:</label>
            <input id="password0" type="password" required name="up0" class="form-control">
        </div>      
        <div class="form-group">
            <label for="password1">New password:</label>
            <input id="password1" type="password" required name="up1" class="form-control">
            <p class="messageErreur" id="messagePass" hidden>Le mot de passe n'est pas assez fort</p>
        </div>
        <div class="progress">
            <div id="complexity-bar" class="progress-bar progress-bar-danger"  role="progressbar" style="width:0%">
            0%</div>
        </div>
        <div class="form-group">
            <label for="password2">Confirm password:</label>
            <input id="password2" type="password" name="up2" class="form-control" placeholder="Tapez d'abord votre mot de passe" disabled>
            <p class="messageErreur" id="messagePass2" hidden>Les mots de passe diffèrent</p>
        </div>
        <button type="submit" class="btn btn-primary">Changez de mot de passe</button>
    </form>
   
CHAINE_DE_FIN;
}else{
    echo '<p>Vous avez changé de mot de passe </p>';
}
echo "</div>";