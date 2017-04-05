<?php

function printLoginForm($askedPage) {
    if($askedPage == 'inscription'){
        $askedPage='welcome';
    }
    echo <<<CHAINE_DE_FIN
    <form class='form'  action='index.php?todo=login&page=$askedPage' method='post'>
    <p>Login : <input type="text" name="login" placeholder="login" required/></p>
    <p>Password : <input type="password" name="password" placeholder="password" required/></p>

    <p><input type="submit" value="Valider" /></p>
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
