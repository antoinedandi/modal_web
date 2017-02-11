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
    public $promotion;
    public $naissance;
    public $email;
    public $feuille;
 
    public function __toString() {
        $ddn= explode('-', $this->naissance);
        $msg="[$this->login] $this->prenom <em>$this->nom</em>, né le $ddn[2]/$ddn[1]/$ddn[0],";
        if ($this->promotion!=NULL) {
            $msg=$msg." X$this->promotion";
        }
        $msg=$msg." <em>$this->email</em> <a href='index.php?page=amis&login=$this->login'>Voir ses amis</a>";
        return $msg;
    }
    public static function getUtilisateur($dbh,$login){
        $query = "SELECT * FROM `utilisateurs` WHERE login = '$login';";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute();
        $user = $sth->fetch();
        $sth->closeCursor();
        return  ($user? $user: null);
    }
    public static function insererUtilisateur($dbh,$login,$mdp,$nom,$prenom,$promotion,$naissance,$email,$feuille){
        if (getUtilisateur($dbh,$login)==null){
            $sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `promotion`, `naissance`, `email`, `feuille`) VALUES(?,SHA1(?),?,?,?,?,?,?)");
            $sth->execute(array("$login","$mdp","$nom","$prenom","$promotion","$naissance","$email","$feuille"));
        }
        else {return "error";}
    }
    public static function testerMdp($dbh,$login,$mdp){
        $user=getUtilisateur($dbh,$login);
        if ($user==null) {return "error";}
        else {return ($user->mdp==$mdp);}
    }
    public static function getAmis($dbh,$login){
        $query = "SELECT * FROM `utilisateurs` JOIN `amis` ON `amis`.`login2`=`utilisateurs`.`login` WHERE `amis`.`login1`='$login';";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute();
        $users = $sth->fetchAll();
        $sth->closeCursor();
        return $users;
    }
    
 
}
?>