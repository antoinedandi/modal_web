<?php
if (isset($_GET['todo'])&&$_GET['todo']=='makeAdmin'){
    $login=$_POST['login'];
    $ok=Utilisateur::rendreAdmin($dbh, $login);
    $login_secure= htmlspecialchars($login);
    echo "<p class='col-md-12 cadre'>";
    if ($ok){
        echo "Vous avez rendu $login_secure administrateur";
    }
    else {
        echo "L'utilisateur n'existe pas";
    }
    echo "</p>";
    
          
}
else{
?>
<form class='col-md-12 cadre' action="index.php?todo=makeAdmin&page=compte" method='post'>
    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden='true'></span></span>
        <input type='text' placeholder="Login" name="login">
    </div><br/>
    <input type="submit" class='btn btn-info' value ="Rendre Administrateur">
</form>
<?php
}