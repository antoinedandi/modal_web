<?php
if (isset($_GET['todo'])&&$_GET['todo']=='upC'){
    $i=$_POST['montant'];
    $ok= Cagnotte::updateMontant($dbh, $i);
    $i_secure= htmlspecialchars($i);
    echo "<p class='col-md-12 cadre'>";
    if ($ok){
        echo "Vous avez augmenté la cagnotte de $i_secure €";
    }
    else {
        echo "Il y a eu une erreur";
    }
    echo "</p>";
    
          
}
else{
?>
<form class='col-md-12 cadre' action="index.php?todo=upC&page=compte" method='post'>
    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-eur" aria-hidden='true'></span></span>
        <input type='number' placeholder="Montant" name="montant">
    </div><br/>
    <input type="submit" class='btn btn-info' value ="Ajouter à la cagnotte">
</form>
<?php
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

