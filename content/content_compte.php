
<div class="jumbotron col-md-12">
    <?php 
    $user=$_SESSION['user'];
    $admin=$user->admin;
    $prenom_secure= htmlspecialchars($user->prenom);
    echo "<h1> Bonjour $prenom_secure</h1>";
    if ($admin){
        echo "<p>Vous êtes admin</p>";
        require 'admin/insererVideoForm.php';
        require 'admin/rendreAdminForm.php';
        require 'admin/ajouterCagnotteForm.php';
        require 'admin/effectuerTirage.php';
    }
    else {
        echo "<p>Vous êtes joueur</p>";
        $solde = $user->solde;
        $tickets = $user-> tickets;
        echo <<<FIN
        <div class="row cadre">
            <div class="col-md-4 col-offset-3">
                <p>Tickets</p>
                <p>$tickets <span class="glyphicons glyphicons-ticket"></span></p>
            </div>
            <div class="col-md-4 col-offset-2">
                <p>Solde</p>
                <p>$solde €</p>
            </div>
                
        </div>
FIN;
         
    }
    echo <<<FIN
    <br/>
    <br/>
        <div class="row">
            <a role="button" class="btn btn-secondary" href="index.php?page=changePassword" >Changer mon mot de passe</a>
            <a role="button" class="btn btn-secondary" href="index.php?page=deleteUser" >Supprimer mon compte</a>
            <a role="button" class="btn btn-secondary" href="index.php?todo=logout" >Deconnexion</a>
        </div>
FIN;
    ?>
</div>

