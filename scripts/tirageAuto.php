<?php
//Script qui effectue un tirage au sort et met la date du prochain tirage au sort à la semaine suivante
ini_set("display_errors",0);error_reporting(0);
require('../utilities/bdd/bdd.php');
require('../utilities/bdd/utilisateur.php');
require('../utilities/bdd/VariablesGlobales.php');
$dbh = Database::connect();

$gagnant = Utilisateur::tirage_au_sort($dbh);
$montant = Cagnotte::getMontant($dbh);
Utilisateur::faireGagner($dbh,$gagnant,$montant);
Cagnotte::resetMontant($dbh);
$date = new DateTime();
$date->setTimestamp(604800+$_POST['date']/1000);
Tirage::setDateTirage($dbh, $date);
return $date;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

