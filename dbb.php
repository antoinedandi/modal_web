<?php
class Database {
    public static function connect() {
        $dsn = 'mysql:dbname=loterie;host=127.0.0.1';
        $user = 'root';
        $password = '';
        $dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }
}
 



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

    public static function deleteUser($dbh,$login){
        $query="DELETE FROM `utilisateurs` WHERE `login`=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array("$login"));
    }
    
}




//$dbh = null; // Déconnexion de MySQL
?>



