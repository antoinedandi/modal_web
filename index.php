<?php
require "utilities/utils.php";

if (isset($_GET['page'])) {
    $askedPage = $_GET['page'];
} else {
    $askedPage = "welcome";
}

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
    generateMenu($page_list);
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
?>
