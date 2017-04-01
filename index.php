<?php
require "utilities/utils.php";
require "dbb.php";
require "Tirage.php";
require "video.php";
require "utilisateur.php";
require "logInOut.php";
require "printForms.php";
session_name("NomSessionDifficileaTrouver");
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
// Décommenter la ligne suivante pour afficher le tableau $_SESSION pour le debuggage
//print_r($_SESSION);

$dbh = Database::connect();

// traitement des contenus de formulaires
//post get
if(isset($_POST["login"]) && isset($_GET["todo"]) && ($_GET["todo"] == "login") ) {
    logIn($dbh);
}

if(isset($_GET["todo"]) && ($_GET["todo"] == "logout")) {
    logOut();
}

// code de sélection des pages, comme précédemment
if (isset($_GET['page'])) {
    $askedPage = $_GET['page'];
} else {
    $askedPage = "welcome";
}

/* debuggage login
// affichage de formulaires
if( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] && isset($_SESSION['login']) ) {
     echo "<p>Bonjour, " . $_SESSION["login"] . " !</p>";
     printLogoutForm();
} else {
    printLoginForm($askedPage);
}
*/

// page title
$authorized = checkPage($askedPage);
if ($authorized == TRUE) {
    $pageTitle = getPageTitle($askedPage);
} else {
    $pageTitle = "Erreur";
}

generateHTMLHeader($pageTitle, 'css/bootstrap.css', 'css/perso.css');
?>

<nav id="menu">
    <?php
        generateMenu($page_list_menu,$askedPage);
    ?>
</nav>

<div class="container-fluid">
    <div id="content">
        <?php
        if ($authorized == TRUE) {
            require "content/content_" . $askedPage . ".php";
        } else {
            echo "<p>Désolé, la page demandée n'existe pas ou n'est accessible qu'aux gentlemen.</p>";
        }
        ?>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/code.js"></script>


<?php
generateHTMLFooter();
?>
