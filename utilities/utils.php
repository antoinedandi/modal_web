<?php

$page_list = array(
    array(
        "name" => "welcome",
        "title" => "Accueil de lotopub",
        "menutitle" => "Accueil"),
    array(
        "name" => "inscription",
        "title" => "inscription",
        "menutitle" => "s'inscrire"),
    array(
        "name" => "news",
        "title" => "on vous tiens au courant",
        "menutitle" => "dernières nouvelles"),
    array(
        "name" => "contacts",
        "title" => "Qui sommes-nous ?",
        "menutitle" => "Nous contacter"),
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

function generateMenu($page_list) {
    echo <<<CHAINE_DE_FIN
    <div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
CHAINE_DE_FIN;

    foreach ($page_list as $page) {
        echo "<li><a href=\"index.php?page=" . $page['name'] . "\">" . $page['title'] . "</a></li>";
    }
    echo <<<CHAINE_DE_FIN
            </ul>
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

