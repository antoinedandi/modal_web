<?php

function logIn($dbh){
    $login=$_POST["login"];
    //echo $login;
    $mdp=$_POST["password"];
    $user=Utilisateur::getUtilisateur($dbh, $login);
    if( $user != NULL  && Utilisateur::testerMdp($dbh,$login,$mdp)){
        $_SESSION["loggedIn"] = TRUE;
        $_SESSION["user"] = $user;
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
    unset($_SESSION["user"]);
}
