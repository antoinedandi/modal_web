<?php

function printLoginForm($askedPage) {
    if($askedPage == 'inscription'){
        $askedPage='welcome';
    }
    echo <<<CHAINE_DE_FIN
    <form class='form'  action='index.php?todo=login&page=$askedPage' method='post'>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
        <input type="text" name="login" class="form-control" placeholder="Login" aria-describedby="basic-addon1" required/>
    </div>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-lock"></span></span>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe" aria-describedby="basic-addon2" required/>
    </div>
    <br/>
    <p><input type="submit" class="btn btn-primary" value="Valider" /></p>
</form>
CHAINE_DE_FIN;
}

function printLogoutForm (){
    echo <<<CHAINE_DE_FIN
    <form action='index.php?todo=logout' method='post'>
        <p><input type="submit" value="Logout" /></p>
    </form>
CHAINE_DE_FIN;
}
