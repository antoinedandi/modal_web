<?php

require('../utilities/bdd/bdd.php');
require('../utilities/bdd/utilisateur.php');
$dbh = Database::connect();
if (isset($_POST['login']) && Utilisateur::getUtilisateur($dbh,$_POST['login'])!=null){
    echo "1";
}
else{
    echo "0";
}

?>