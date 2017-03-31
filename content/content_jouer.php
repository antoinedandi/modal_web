<?php
    function afficher_video($video){
        echo <<<CHAINE_DE_FIN
        <div>
            <video src="img/$video" controls ></video>   
        </div>
CHAINE_DE_FIN;
    }
    
    function afficher_questions($question,$rep1,$rep2,$rep3,$rep4){
        echo <<<CHAINE_DE_FIN
        <fieldset class="form-group row cadre">
          <legend class="col-form-legend col-sm-2">$question</legend>
          <div class="col-sm-8 col-md-offset-2">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                $rep1
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2" checked>
                $rep2
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" checked>
                $rep3
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="option4" checked>
                $rep4
              </label>
            </div>
          </div>
        </fieldset>
CHAINE_DE_FIN;
    }
?>

<div class="row col-md-10 col-md-offset-1"> 
    <?php
        afficher_video("Lucky_Charmz.webmsd.webm");
        afficher_questions("??","1.","vgvgv","vygyftdrsrs","aucune idée connard");
        afficher_questions("??","1.","vgvgv","vygyftdrsrs","aucune idée connard");
        afficher_questions("??","1.","vgvgv","vygyftdrsrs","aucune idée connard");
        afficher_questions("??","1.","vgvgv","vygyftdrsrs","aucune idée connard");
    ?>  
</div>
