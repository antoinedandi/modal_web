<?php
require "utilities/utils.php";
require "utilities/logInOut.php";
require "utilities/printForms.php";
require "utilities/bdd/bdd.php";
require "utilities/bdd/VariablesGlobales.php";
require "utilities/bdd/video.php";
require "utilities/bdd/utilisateur.php";
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
if (isset($_POST["login"]) && isset($_GET["todo"]) && ($_GET["todo"] == "login")) {
    logIn($dbh);
}

if (isset($_GET["todo"]) && ($_GET["todo"] == "logout")) {
    logOut();
}

// code de sélection des pages, comme précédemment
if (isset($_GET['page'])) {
    $askedPage = $_GET['page'];
} else {
    $askedPage = "welcome";
}

// page title
$authorized = checkPage($askedPage);
if ($authorized == TRUE) {
    $pageTitle = getPageTitle($askedPage);
} else {
    $pageTitle = "Erreur";
}

generateHTMLHeader($pageTitle, 'css/bootstrap.css', 'css/style_3.css');
?>

<nav id="menu">
    <?php
    generateMenu($dbh,$page_list_menu, $askedPage);
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
<script type="text/javascript" src="js/jquery.complexify.js"></script>
<script type="text/javascript" src="js/validation.js"></script>

<!-- Code javascript du compte à rebours -->
<script src="js/jquery.countdown.js"></script>
<script src="js/code.js"></script>
<?php
$date = Tirage::getDateTirage($dbh);
$annee = $date[0];
//les mois commencent à 0
$mois = $date[1]-1;
$jour = $date[2];
?>
<script>
    //Déclaration de la variable globale 
    var endTime = new Date(<?php echo $annee ?>,<?php echo $mois ?>,<?php echo $jour ?>);
</script>

<?php
generateHTMLFooter();
