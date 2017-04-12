<div class="col-md-7 cadre_transparent">
    <h2>Prochain tirage dans</h2>

    <div class="cell">
        <div id="holder">
            <div class="digits"></div>
        </div>
    </div>    

</div> 

<script>
    //Animation du compte à rebours
<?php
$date = Tirage::getDateTirage($dbh);
$annee = $date[0];
$mois = $date[1];
$jour = $date[2];
?>
    var endTime = new Date(<?php echo $annee ?>,<?php echo $mois ?>,<?php echo $jour ?>);
    $(".digits").countdown({
        image: "img/digits.png",
        format: "hh:mm:ss",
        endTime: endTime
    });

</script>
