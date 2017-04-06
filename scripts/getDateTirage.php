<?php

require('../utilities/bdd/dbb.php');
require('../utilities/bdd/VariablesGlobales.php');
$dbh = Database::connect();
echo Tirage::getDateTirage($dbh);

?>