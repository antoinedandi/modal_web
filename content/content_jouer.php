<?php

function afficher_video($video) {
    echo <<<CHAINE_DE_FIN
        <div class="container-fluid row col-md-8 col-md-offset-2">
            <video src="videos/$video->nom" controls ></video>   
        </div>
CHAINE_DE_FIN;
}

function afficher_questions($question, $rep) {
    //print_r($rep);
    shuffle($rep);
    //print_r($rep);
    echo <<<CHAINE_DE_FIN
        <div class="container-fluid row col-md-8 col-md-offset-2">
        <form class="form-group row cadre" action="?page=jouer" method="post">
          <legend class="col-form-legend col-sm-2">$question</legend>
          <div class="col-sm-8 col-md-offset-2">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep[0]" checked>
                $rep[0]
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep[1]" >
                $rep[1]
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep[2]" >
                $rep[2]
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep[3]" >
                $rep[3]
              </label>
            </div>
            <button type="submit" class="btn btn-default">Valider</button>
          </div>
        </form>
        </div>
CHAINE_DE_FIN;
}

$form_values_valid = false;
$id = "1";
$video = Video::getVideoWithID($dbh, $id);
$reponses = array($video->right_answer, $video->wrong_answer1, $video->wrong_answer2, $video->wrong_answer3);

//On ne peut accéder au jeu que si on est logé
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    if ($_SESSION['user']->admin) {
        echo <<<FIN
        <div class='col-md-8 col-md-offset-2 cadre transparent'>
            <p>Vous êtes Administrateur donc pas là pour jouer</p>
        </div>
FIN;
    } else {
        if (isset($_POST["choix"])) {

            // code de traitement

            if (($video != NULL) && (Video::testerReponse($dbh, $id, $_POST["choix"]))) {
                $form_values_valid = true;
                Utilisateur::incrementTickets($dbh, $_SESSION["user"]->login);
                Cagnotte::updateMontant($dbh, 1);
            } else {
                echo <<<FIN
        <div class="row col-md-8 col-md-offset-2 cadre">
                <p>Mauvaise réponse !</p>
        </div>
FIN;
            }
        }

        if (!$form_values_valid) {
            afficher_video($video);
            afficher_questions($video->question, $reponses);
        } else {
            echo <<<FIN
        <div class="row col-md-8 col-md-offset-2 cadre">
                <p>Bravo! Vous avez gagné un ticket!!</p>
        </div>
FIN;
        }
    }
} else {
    echo <<<FIN
    <div class='col-md-8 col-md-offset-2 cadre transparent'>
        <p>Il faut être connecté pour accéder au jeu</p>
FIN;
    printLoginForm("jouer");
    echo "</div>";
}   