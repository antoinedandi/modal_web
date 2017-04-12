<?php
if (isset($_GET['todo']) && $_GET['todo'] == 'doTirage') {
    $gagnant = Utilisateur::tirage_au_sort($dbh);

    $montant = Cagnotte::getMontant($dbh);
    Utilisateur::faireGagner($dbh,$gagnant,$montant);
    Cagnotte::resetMontant($dbh);
    
    echo "<p class='cadre'>";

    echo "Bravo, $gagnant a gagné la loterie";
    echo "</p>";
} else {
    ?>
    <form class='cadre' action="index.php?todo=doTirage&page=compte" method='post'>
        <input type="submit" class='btn btn-info center-block' value ="effectuer un tirage au sort">
    </form>
    <?php
}
