<?php
require 'video.php';
if(isset($_GET["todo"]) && ($_GET["todo"] == "submitVideo")) {
    $nom=$_POST["nom"];
    $nom_secure= htmlspecialchars($nom);
    $question=htmlspecialchars($_POST['question']);
    $right_answer=htmlspecialchars($_POST['ra']);
    $wrong_answer1=htmlspecialchars($_POST['wa1']);
    $wrong_answer2=htmlspecialchars($_POST['wa2']);
    $wrong_answer3=htmlspecialchars($_POST['wa3']);
    echo "<p class='cadre row'>";
        if (Video::insererVideo($dbh, $nom, $question, $right_answer, $wrong_answer1, $wrong_answer2, $wrong_answer3)){
            echo "Votre vidéo $nom_secure a été ajoutée avec succès";
        }
        else {
            echo "Il y a eu une erreur dans l'ajout de la vidéo";
        }
    echo "</p>";
    
}
else{
?>
<form class='col-md-12 cadre' action="index.php?todo=submitVideo&page=compte" method='post'>
    <label class="control-label">Selectionner une vidéo</label>
    <input id="video" type="file" class="file">
    <label for="question">Nom : </label><input type='text' placeholder="Nom de la vidéo" name="nom" id="question"><br/>
    <label for="question">Question : </label><input type='text' placeholder="Question" name="question" id="question"><br/>
    <label for="ra">Entrez les choix de réponses souhaités : </label>
    <div class='row'>
        <input type='text' placeholder="Bonne réponse" name="ra" id="ra">
        <input type='text' placeholder="Réponse erronée" name="wa1">
        <input type='text' placeholder="Réponse erronée" name="wa2">
        <input type='text' placeholder="Réponse erronée" name="wa3">
    </div>
    <input type="submit" class='btn btn-info' value ="Ajouter la vidéo">
</form>
<br/>
<?php 
}


