
<h2>Voir les amis de :
<?php
if (isset($_GET['login'])){
        $login=$_GET['login'];
        echo "$login";
}
echo"</h2>";
$value=isset($login)?$login:'';

echo <<<FIN
<form action="index.php" method="GET">
    <input type="text" maxlength="64" name="login" placeholder="Saisissez un login valide" value="$value">
    <input type="hidden" name="page" value="amis">
</form>
FIN;
if (isset($_GET['login'])){
        $friends= Utilisateur::getAmis($dbh, $login);
        echo "<div class='col-md-10 col-md-offset-1 lisible'>";
        foreach ($friends as $friend) {
            echo "<div class='row'>$friend </div>";
        }
        echo "</div>";
}

?>