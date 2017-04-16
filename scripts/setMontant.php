<?php
//Script qui n'est utile que pour le débuggage
ini_set("display_errors",0);error_reporting(0);
require('../utilities/bdd/bdd.php');
require('../utilities/bdd/VariablesGlobales.php');
$dbh = Database::connect();
echo Cagnotte::updateMontant($dbh,'2');

?>