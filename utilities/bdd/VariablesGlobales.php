<?php

class Cagnotte {

    private $nom;
    private $montant; //Le montant n'est pas accessible car il doit être toujours à jour

    //avec la bdd. 

    public static function getMontant($dbh) {
        $query = "SELECT `Valeur` FROM `variables_globales` WHERE `Nom` = 'cagnotte'";
        $sth = $dbh->prepare($query);
        if (!$sth->execute()) {
            return "Il manque un message d'erreur ici";
        }
        $c = $sth->fetch(PDO::FETCH_ASSOC);
        $sth->closeCursor();
        return $c['Valeur'];
    }

    public static function updateMontant($dbh, $i) {
        $query = "UPDATE `variables_globales` SET `valeur`=`valeur`+?  WHERE `nom`='cagnotte'";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Cagnotte');
        $sth->execute(array("$i"));
        return $sth;
    }

    public static function resetMontant($dbh) {
        $query = "UPDATE `variables_globales` SET `valeur`=0  WHERE `nom`='cagnotte'";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Cagnotte');
        $sth->execute();
        return $sth;
    }

}

class Tirage {
    public static function getDateTirage($dbh) {
        $query = "SELECT `Date_tirage` FROM `variables_globales` WHERE `Nom` = 'tirage'";
        $sth = $dbh->prepare($query);
        if (!$sth->execute()) {
            return "Il manque un message d'erreur ici";
        }
        $c = $sth->fetch(PDO::FETCH_ASSOC);
        $sth->closeCursor();
        $elements=explode(' ', $c['Date_tirage']);
        $date=explode('-', $elements[0]);
       
        return $date;
    }
    public static function setDateTirage($dbh,$new_date) {
        $query = "UPDATE `variables_globales` SET `date_tirage`=?  WHERE `nom`='tirage'";
        $sth = $dbh->prepare($query);
        $sth->execute(array("$new_date"));
        return $sth;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

