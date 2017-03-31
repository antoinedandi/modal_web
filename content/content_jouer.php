<?php
    function afficher_video($video){
        echo <<<CHAINE_DE_FIN
        <div class="container-fluid row col-md-8 col-md-offset-2">
            <video src="img/$video" controls ></video>   
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
                <input class="form-check-input" type="radio" name="choix" value="1" checked>
                $rep1
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="2">
                $rep2
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="3">
                $rep3
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="choix" value="4">
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
$bonne_reponse=$reponse;


function corriger($reponse){
      if((isset($choixdujoueur)) && ($reponse == $choixdujoueur)){
      $form_values_valid = true;
  }
}
    
    
    
function jeu($video,$question,$reponse,$rep1,$rep2,$rep3,$rep4){
     afficher_video($video);
     afficher_questions($question,$reponse,$rep1,$rep2,$rep3,$rep4);
}


if (isset($_POST["choix"])) $choixdujoueur = $_POST["choix"];

    
// code de traitement du formulaire : 
    


  
  if(!$form_values_valid){
      afficher_video("Lucky_Charmz.webmsd.webm");
      afficher_questions("??","3","1.","vgvgv","vygyftdrsrs","aucune idée connard");
  }
  else{
      echo 'bravo vous avez gagné un ticket';
  }

     


