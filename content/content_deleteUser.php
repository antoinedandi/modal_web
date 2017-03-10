<?php

$delete_account_valid=false;
$login=$_SESSION['login'];

    
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

    

if (!$delete_account_valid) {
    echo <<<CHAINE_DE_FIN
    <div class="container-fluid row col-md-8 col-md-offset-2">
    <div>
        <p> $login, voulez vous supprimer votre compte? </p>
    </di>
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
    echo 'vous avez supprimé votre compte ';
    logOut();
}

