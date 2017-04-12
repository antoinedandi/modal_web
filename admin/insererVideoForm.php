<?php

if (isset($_GET["todo"]) && ($_GET["todo"] == "submitVideo")) {
    echo "<p class='cadre row'>";
    $temp=empty($_FILES['video']['tmp_name']);
    $aux=is_uploaded_file($_FILES['video']['tmp_name']);
    if (!empty($_FILES['video']['tmp_name']) && is_uploaded_file($_FILES['video']['tmp_name'])) {
        // Le fichier a bien été téléchargé

        /* Téléchargement de la vidéo sur le serveur */
        $nom = $_FILES['video']["name"];
        $allowedExtensions = array("mp4", "mpeg", "webm", "avi");
        //Vérifications type de fichier 
        if (!in_array(end(explode(".", $_FILES['video']['name'])), $allowedExtensions)) {
            echo "Le type de fichier est incorrect";
        } else {
            $taille_maxi = 100000;
            $taille = filesize($_FILES['video']['tmp_name']);
            if ($taille > $taille_maxi) {
                $erreur = "Le ficher est trop volumineux!";
            }
            //On met l'image dans le bon dossier
            if (!move_uploaded_file($_FILES['video']['tmp_name'], 'videos/' . $nom)) {
                echo "Echec de la copie sur le serveur";
            }

            /* Ajout de la vidéo dans la base de données */
            $nom_secure = htmlspecialchars($nom);
            $question = htmlspecialchars($_POST['question']);
            $right_answer = htmlspecialchars($_POST['ra']);
            $wrong_answer1 = htmlspecialchars($_POST['wa1']);
            $wrong_answer2 = htmlspecialchars($_POST['wa2']);
            $wrong_answer3 = htmlspecialchars($_POST['wa3']);

            if (Video::insererVideo($dbh, $nom, $question, $right_answer, $wrong_answer1, $wrong_answer2, $wrong_answer3)) {
                echo "Votre vidéo $nom_secure a été ajoutée avec succès";
            }
        }
    } else {
        echo "Il y a eu une erreur dans le téléchargement de la vidéo";
    }
    echo "</p>";
} else {
    ?>
    <form class='cadre' action="index.php?todo=submitVideo&page=compte" method='post' enctype="multipart/form-data">
        <label class="control-label">Selectionner une vidéo</label>
        <input name="video" type="file" class="file">
        <label for="question">Question : </label>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-question-sign" aria-hidden='true'></span></span>
            <input type='text' placeholder="Question" name="question" id="question">
        </div><br/>
        <br/>
        <label for="ra">Entrez les choix de réponses souhaités : </label><br/>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-ok" aria-hidden='true'></span></span>
            <input type='text' placeholder="Bonne réponse" name="ra" id="ra">
        </div><br/>

        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <input type='text' placeholder="Réponse erronée" name="wa1">
        </div><br/>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <input type='text' placeholder="Réponse erronée" name="wa2">
        </div><br/>
        <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <input type='text' placeholder="Réponse erronée" name="wa3">
        </div><br/>
        <input type="submit" class='btn btn-info' value ="Ajouter la vidéo">
    </form>
    <?php
}


