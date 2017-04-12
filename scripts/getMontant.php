<?php

require('../utilities/bdd/bdd.php');
require('../utilities/bdd/VariablesGlobales.php');
$dbh = Database::connect();
echo Cagnotte::getMontant($dbh);

?>