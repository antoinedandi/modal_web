<?php
if(isset($_GET["todo"]) && ($_GET["todo"] == "submit")) {
    
}
else{
?>
<form class='col-md-12 cadre' action="index.php?todo=submit&page=compte" method='post'>
    <label class="control-label">Selectionner une vidéo</label>
    <input id="input-1" type="file" class="file">
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


