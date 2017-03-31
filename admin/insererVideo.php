<?php
require 'video.php';
if (isset($_GET["todo"]) && ($_GET["todo"] == "submitVideo")) {
    $nom = $_POST["nom"];
    $nom_secure = htmlspecialchars($nom);
    $question = htmlspecialchars($_POST['question']);
    $right_answer = htmlspecialchars($_POST['ra']);
    $wrong_answer1 = htmlspecialchars($_POST['wa1']);
    $wrong_answer2 = htmlspecialchars($_POST['wa2']);
    $wrong_answer3 = htmlspecialchars($_POST['wa3']);
    echo "<p class='cadre row'>";
    if (Video::insererVideo($dbh, $nom, $question, $right_answer, $wrong_answer1, $wrong_answer2, $wrong_answer3)) {
        echo "Votre vidéo $nom_secure a été ajoutée avec succès";
    } else {
        echo "Il y a eu une erreur dans l'ajout de la vidéo";
    }
    echo "</p>";
} else {
    ?>
    <form class='col-md-12 cadre' action="index.php?todo=submitVideo&page=compte" method='post' enctype="multipart/form-data">
        <label class="control-label">Selectionner une vidéo</label>
        <input id="video" type="file" class="file">
        <label for="question">Question : </label>
        <div class="input-group">
            <span class="input-group-addon">?</span>
            <input type='text' placeholder="Question" name="question" id="question">
        </div><br/>
        <br/>
        <label for="ra">Entrez les choix de réponses souhaités : </label><br/>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicons glyphicons-ok" aria-hidden='true'></span></span>
            <input type='text' placeholder="Bonne réponse" name="ra" id="ra">
        </div><br/>
        
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicons glyphicons-ok"></span></span>
            <input type='text' placeholder="Réponse erronée" name="wa1">
        </div><br/>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicons glyphicons-ok"></span></span>
            <input type='text' placeholder="Réponse erronée" name="wa2">
        </div><br/>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicons glyphicons-ok"></span></span>
            <input type='text' placeholder="Réponse erronée" name="wa3">
        </div><br/>
        <input type="submit" class='btn btn-info' value ="Ajouter la vidéo">
    </form>
    <br/>
    <?php
}


