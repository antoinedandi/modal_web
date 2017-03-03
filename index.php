<?php
session_name("SessionUtilisateur");
// ne pas mettre d'espace dans le nom de session !
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}

// Décommenter la ligne suivante pour afficher le tableau $_SESSION pour le debuggage
//print_r($_SESSION);
require "utilities/utils.php";
require 'dbb.php';
require 'login/printForms.php';
require 'login/LogInOut.php';

$dbh = Database::connect();

if (isset($_GET['page'])) {
    $askedPage = $_GET['page'];
} else {
    $askedPage = "welcome";
}

$authorized = checkPage($askedPage);
if ($authorized) {
    $pageTitle = getPageTitle($askedPage);
} else {
    $pageTitle = "Erreur";
}
$errors = array('login' => false, 'mdp' => false);
if (isset($_GET['todo'])) {
    if ($_GET['todo'] == 'login') {
        $errors = LogIn($dbh);
    } elseif ($_GET['todo'] == 'logout') {
        LogOut();
    }
}
generateHTMLHeader($pageTitle, 'css/bootstrap.css', 'css/perso.css');
?>

<nav id="menu">
    <?php
    generateMenu($page_list);
    ?>
</nav>

<div class="container-fluid">

    <div id="content">
        <?php
        if (isset($_GET['todo']) && $_GET['todo'] == 'register') {
            echo "bla";
            require 'login/register.php';
        } else {
            echo "<div class='row'>";
            if ($authorized) {
                echo "<div class='col-md-9'>";
                require "content/content_" . $askedPage . ".php";
                echo "</div>";
                // affichage de formulaires
                if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
                    printLogOutForm($askedPage,$_SESSION['user']);
                } else {
                    printLoginForm($askedPage, $errors['login'], $errors['mdp']);
                }
            } else {
                echo "<p>Désolé, la page demandée n'existe pas ou n'est accessible qu'aux gentlemen.</p>";
            }
            echo "</div>";
        }
        ?>
    </div>

    <div id="footer">
        <p>site réalisé en modal par Manon et Antoine</p>
    </div>
</div>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>


<?php
generateHTMLFooter();
$dbh = null;
//session_unset();
//session_destroy();
?>

