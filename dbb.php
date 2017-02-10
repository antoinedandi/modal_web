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
function insererUtilisateur($dbh,$login,$mdp,$nom,$prenom,$promotion,$naissance,$email,$feuille){
    $sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `promotion`, `naissance`, `email`, `feuille`) VALUES(?,SHA1(?),?,?,?,?,?,?)");
    $sth->execute(array("$login","$mdp","$nom","$prenom","$promotion","$naissance","$email","$feuille"));
 }
 
 
// opérations sur la base
$dbh = Database::connect();
insererUtilisateur($dbh,'manon643', 'bla','Romain', 'Manon', '2015', '26/06/1996', 'manonr96@gmail.com', 'bla.css');
$dbh = null; // Déconnexion de MySQL
?>