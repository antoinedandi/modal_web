<?php
class Database {
    public static function connect() {
        $dsn = 'mysql:dbname=fsdhfkjl;host=127.0.0.1';
        $user = 'root';
        $password = 'eau_de_feu';
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
 
 
// opérations sur la base
$dbh = Database::connect();
$dbh->query("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `promotion`, `naissance`, `email`, `feuille`) VALUES('moi',SHA1('nombril'),'bebe','louis','2005','1980-03-27','Marcel.Dupont@polytechnique.edu','modal.css')");
$sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `promotion`, `naissance`, `email`, `feuille`) VALUES(?,SHA1(?),?,?,?,?,?,?)");
$sth->execute(array('SuperMarcel','Mystere','Marcel','Dupont','2005','1980-03-27','Marcel.Dupont@polytechnique.edu','modal.css'));
 
$dbh = null; // Déconnexion de MySQL
?>