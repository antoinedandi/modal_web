<?php
require('../utilities/bdd/bdd.php');
require('../utilities/bdd/utilisateur.php');
require('../utilities/bdd/VariablesGlobales.php');
$dbh = Database::connect();

$gagnant = Utilisateur::tirage_au_sort($dbh);
$montant = Cagnotte::getMontant($dbh);
Utilisateur::faireGagner($dbh,$gagnant,$montant);
Cagnotte::resetMontant($dbh);
$date = new DateTime(604800+$_POST['date'],new DateTimeZone('Paris/Europe'));

return Tirage::setDateTirage($dbh, $date);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

