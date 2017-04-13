<?php

$delete_account_valid=false;
$login=$_SESSION['user']->login;
$login_secure= htmlspecialchars($login);

    
// code de traitement du formulaire : 
    
if(isset($_POST["up"]) && $_POST["up"] != "") {  
        
  // code de traitement, à écrire maintenant
  
  if((Utilisateur::getUtilisateur($dbh, $login) != NULL) && (Utilisateur::testerMdp($dbh,$login,$_POST["up"])) ){
      
      Utilisateur::deleteUser($dbh, $login);
      $delete_account_valid = true;
      echo $delete_account_valid;    
  }
 else {
    echo'erreur';
  }
}

    
echo "<div class='container-fluid cadre_transparent row col-md-8 col-md-offset-2'>";
if (!$delete_account_valid) {
    echo <<<CHAINE_DE_FIN
    
        <h2> $login_secure, voulez vous supprimer votre compte? </h2>
    <form action="?page=deleteUser" method="post" ">
        <div class="form-group">
            <label for="password">Password:</label>
            <input id="password" type="password" required name="up" class="form-control">
        </div>      
        <button type="submit" class="btn btn-default">Supprimer le compte</button>
    </form>
</div>   
CHAINE_DE_FIN;
}else{
    echo '<h2>Vous avez supprimé votre compte</h2> ';
    logOut();
}
echo "</div>";

