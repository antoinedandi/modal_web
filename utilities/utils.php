<?php

$page_list = array(
    array(
        "name" => "welcome",
        "title" => "Accueil de lotopub",
        "menutitle" => "Accueil"),
    array(
        "name" => "jouer",
        "title" => "Le jeu",
        "menutitle" => "Jouer !"),
    array(
        "name" => "inscription",
        "title" => "inscription",
        "menutitle" => "s'inscrire"),
    array(
        "name" => "news",
        "title" => "on vous tient au courant",
        "menutitle" => "dernières nouvelles"),
    array(
        "name" => "contacts",
        "title" => "Qui sommes-nous ?",
        "menutitle" => "Nous contacter"),
    array(
        "name" => "changePassword",
        "title" => "changer de mot de passe",
        "menutitle" => "changer de mot de passe"),
    array(
        "name" => "deleteUser",
        "title" => "supprimer votre compte",
        "menutitle" => "supprimer compte"),
    array(
        "name" => "compte",
        "title" => "Mon Compte",
        "menutitle" => "Mon Compte")
);

$page_list_menu = array(
    array(
        "name" => "welcome",
        "title" => "Accueil",
        "menutitle" => "Accueil"),
    array(
        "name" => "jouer",
        "title" => "Le jeu",
        "menutitle" => "Jouer !"),
    array(
        "name" => "news",
        "title" => "on vous tient au courant",
        "menutitle" => "dernières nouvelles"),
    array(
        "name" => "contacts",
        "title" => "Qui sommes-nous ?",
        "menutitle" => "Nous contacter"),
    array(
        "name" => "compte",
        "title" => "Mon Compte",
        "menutitle" => "Mon Compte")
);

function checkPage($askedPage) {
    global $page_list;
    $ok = FALSE;
    foreach ($page_list as $page) {
        if ($page["name"] == $askedPage) {
            $ok = TRUE;
        }
    }
    return $ok;
}

function getPageTitle($askedPage) {
    global $page_list;
    foreach ($page_list as $page) {
        if ($page["name"] == $askedPage) {
            return $page["title"];
        }
    }
}

function generateMenu_not_loggedIn($page_list_menu, $askedPage) {
    echo <<<CHAINE_DE_FIN
    <div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
CHAINE_DE_FIN;

    foreach ($page_list_menu as $page) {
        echo "<li><a href=\"index.php?page=" . $page['name'] . "\">" . $page['title'] . "</a></li>";
    }
    echo <<<FIN
     </ul>
            <div class="pull-right">
                <ul class="nav navbar-nav pull-right">
FIN;
    if (isset($_SESSION['loggedIn'])) {
        echo <<<CHAINE_DE_FIN
           
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome $login! <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href=index.php?page=changePassword><i class="icon-cog"></i> change password</a></li>
                            <li><a href=index.php?page=deleteUser><i class="icon-envelope"></i> delete account</a></li>
                            <li class="divider"></li>
                            <li><form action='index.php?todo=logout' method='post'>
                                    <p><input type="submit" value="Logout" /></p>
                                </form>
                            </li>
                        </ul>
                    </li>
CHAINE_DE_FIN;
    } else {
        echo <<<CHAINE_DE_FIN
                    <li class="dropdown" id="menuLogin">
                        <a class="dropdown-toggle menu-item" href="#" data-toggle="dropdown" id="navLogin">Login</a>
                        <div class="dropdown-menu" style="padding:17px;">
CHAINE_DE_FIN;
        printLoginForm($askedPage);
        echo <<<CHAINE_DE_FIN
                        </div>
                    </li>
                    <li><a href='index.php?page=inscription' class='menu-item'> S'inscrire </a></li>
CHAINE_DE_FIN;
    }
    echo <<<FIN
    </ul>
            </div>
        </div>
    </div>
    </div>
FIN;
}

function generateMenu_loggedIn($page_list_menu) {
    $login = $_SESSION['login'];
    echo <<<CHAINE_DE_FIN
    <div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
CHAINE_DE_FIN;

    foreach ($page_list_menu as $page) {
        echo "<li><a class='test' href=\"index.php?page=" . $page['name'] . "\">" . $page['title'] . "</a></li>";
    }
    echo <<<CHAINE_DE_FIN
            </ul>
            <div class="pull-right">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome $login! <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href=index.php?page=changePassword><i class="icon-cog"></i> change password</a></li>
                            <li><a href=index.php?page=deleteUser><i class="icon-envelope"></i> delete account</a></li>
                            <li class="divider"></li>
                            <li><form action='index.php?todo=logout' method='post'>
                                    <p><input type="submit" value="Logout" /></p>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
CHAINE_DE_FIN;
}

function generateHTMLHeader($titre, $link_1_css, $link_2_css) {
    echo <<<CHAINE_DE_FIN
                <!DOCTYPE html>
                <html>
                    <head>
                        <meta charset="UTF-8">
                        <title>$titre</title>
                        <link href="$link_1_css" rel="stylesheet">
                        <link href="$link_2_css" rel="stylesheet">
                        
                    </head>
                    <body>
CHAINE_DE_FIN;
}

function generateHTMLFooter() {
    echo <<<CHAINE_DE_FIN
                    </body>
                </html>
CHAINE_DE_FIN;
}
?>

