<?php
if (isset($_GET['todo'])&&$_GET['todo']=='doTirage'){
    Utilisateur::tirage_au_sort($dbh);
    echo "<p class='col-md-12 cadre'>";
    
    echo "</p>";
    
          
}
else{
?>
<form class='col-md-12 cadre' action="index.php?todo=doTirage&page=compte" method='post'>
    <input type="submit" class='btn btn-info center-block' value ="effectuer un tirage au sort">
</form>
<?php
}
