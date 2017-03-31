<?php

class Utilisateur {
    public $login;
    public $mdp;
    public $nom;
    public $prenom;
    public $naissance;
    public $email;
    public $solde;
    public $tickets;
    public $admin;
 
    public function __toString() {
        return '['.$this->login.'] '.$this->prenom.' '.$this->nom;
    }
    
    public static function getUtilisateur($dbh, $login) {
        $query = "SELECT * FROM `utilisateurs` WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array("$login"));
        $user = $sth->fetch();
        // $sth : boolean qui dit si ca a marché ou pas
        $sth->closeCursor();
        return ($sth)? $user: null;
    }
    
    public static function insererUtilisateur($dbh, $login, $mdp, $nom, $prenom, $naissance, $email) {
        if (Utilisateur::getUtilisateur($dbh, $login) == null){
            $sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `naissance`, `email`) VALUES(?,SHA1(?),?,?,?,?)");
            $sth->execute(array($login, $mdp, $nom, $prenom, $naissance, $email));
            return TRUE;
        }
        else{
            echo 'impossible login deja pris!!!';
            return FALSE;
        }   
    }
    
    public static function testerMdp($dbh,$login,$mdp) {
        $a= sha1($mdp);
        $test=Utilisateur::getUtilisateur($dbh, $login);
        return $a==$test->mdp;
        // -> represente l'attribut mdp de l'user '$test
    }
    
    public static function changeMdp($dbh,$login,$mdp){
        $query="UPDATE `utilisateurs` SET `mdp`='$mdp'  WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array("$login"));
    }
    public static function rendreAdmin($dbh,$login){
        $query="UPDATE `utilisateurs` SET `admin`='1'  WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array("$login"));
        return $sth;
    }

    public static function deleteUser($dbh,$login){
        $query="DELETE FROM `utilisateurs` WHERE `login`=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array("$login"));
    }
    public static function incrementTickets($dbh,$user){
        $query="UPDATE `utilisateurs` SET `tickets`='1'  WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array("$user->login"));
        return $sth;
    }
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

