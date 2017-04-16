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
        $salt="1ZnAHv8!èpm98";
        $mdp=$mdp.$salt;
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
        $salt="1ZnAHv8!èpm98";
        $a= sha1($mdp.$salt);
        $test=Utilisateur::getUtilisateur($dbh, $login);
        return $a==$test->mdp;
        // -> represente l'attribut mdp de l'user '$test
    }
    
    public static function changeMdp($dbh,$login,$mdp){
        $salt="1ZnAHv8!èpm98";
        $query="UPDATE `utilisateurs` SET `mdp`='$mdp.$salt'  WHERE login=?";
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
    public static function incrementTickets($dbh,$login){
        $query="UPDATE `utilisateurs` SET `tickets`=`tickets`+1  WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array($login));
        return $sth;
    }
    
    public static function incrementSolde($dbh,$i,$login){
        $query="UPDATE `utilisateurs` SET `solde`=`solde`+? WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array($i,$login));
        return $sth;
    }
    
    public static function incrementNotif($dbh,$login,$i){
        $query="UPDATE `utilisateurs` SET `notification`=? WHERE login=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        if($i==1){
            $sth->execute(array(TRUE,$login));
        }
        else{
            $sth->execute(array(NULL,$login)); 
        }
        return $sth;
    }
    
    public static function faireGagner($dbh, $login, $montant){
        Utilisateur::incrementNotif($dbh,$login,1);
        $sth1= Utilisateur::incrementSolde($dbh,$montant,$login);
        //On remet tous les tickets à zéro
        if ($sth1){
            $query="UPDATE `utilisateurs` SET `tickets`=0";
            $sth = $dbh->prepare($query);
            $sth->execute();
            return $sth;
        }
        return false;
        
    }

    public static function tirage_au_sort($dbh) {
        $query = "SELECT login, tickets FROM `utilisateurs`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute();
        $users = $sth->fetchAll();
        // $sth : boolean qui dit si ca a marché ou pas
        $sth->closeCursor();
        //$users_ponderé : array qui comporte les logins des utilisateurs 
        //ponderé par leur nombre de tickets
        $users_pondere = array();
        foreach ($users as $value) {
            for ($i = 0; $i < $value->tickets; $i++) {
                array_push($users_pondere, $value->login);
            }
        }
        //print_r($users_pondere);
        if(empty($users_pondere)){
            return NULL;
        }
        $gagnant = $users_pondere[array_rand($users_pondere)]; 
        return ($sth) ? $gagnant : null;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

