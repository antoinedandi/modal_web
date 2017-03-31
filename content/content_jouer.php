<?php
    function afficher_video($video){
        echo <<<CHAINE_DE_FIN
        <div class="container-fluid row col-md-8 col-md-offset-2">
            <video src="videos/$video->nom" controls ></video>   
        </div>
CHAINE_DE_FIN;
    }
    
    function afficher_questions($question,$rep1,$rep2,$rep3,$rep4){
        echo <<<CHAINE_DE_FIN
        <div class="container-fluid row col-md-8 col-md-offset-2">
        <form class="form-group row cadre" action="?page=jouer" method="post">
          <legend class="col-form-legend col-sm-2">$question</legend>
          <div class="col-sm-8 col-md-offset-2">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep1" checked>
                $rep1
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep2">
                $rep2
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep3">
                $rep3
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="$rep4">
                $rep4
              </label>
            </div>
            <button type="submit" class="btn btn-default">Valider</button>
          </div>
        </form>
        </div>
CHAINE_DE_FIN;
    }
 
    
$form_values_valid=false;
$id="1";
$video=Video::getVideoWithID($dbh, $id);

// code de traitement du formulaire : 
    
if(isset($_POST["choix"])) {
      
  // code de traitement, à écrire maintenant
  
  if(($video != NULL) && (Video::testerReponse($dbh,$id,$_POST["choix"])) ){     
      $form_values_valid = true;
      echo $form_values_valid;   
  }
 else {
    echo'mauvaise réponse';
  }
}
  
  if(!$form_values_valid){
      afficher_video($video);
      afficher_questions($video->question,$video->right_answer,$video->wrong_answer1,$video->wrong_answer1,$video->wrong_answer1);
  }
  else{
      echo 'bravo vous avez gagné un ticket';
  }

     


