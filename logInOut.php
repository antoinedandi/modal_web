<?php

function logIn($dbh){
    $login=$_POST["login"];
    //echo $login;
    $mdp=$_POST["password"];
    if(Utilisateur::getUtilisateur($dbh, $login) != NULL  && Utilisateur::testerMdp($dbh,$login,$mdp)){
        $_SESSION["loggedIn"] = TRUE;
        $_SESSION["login"] = $login;
        //echo $_SESSION["loggedIn"];
        //echo 'connexion reussie';
    }
    else{
        $_SESSION["loggedIn"] = FALSE;
        //echo $_SESSION["loggedIn"];
        //echo 'connexion ratée';
    }
}

function logOut(){
    unset($_SESSION["loggedIn"]);
    unset($_SESSION["login"]);
}
