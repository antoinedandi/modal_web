<div class="col-md-12">

    <?php 
    //On met à jour le user stocké dans SESSION pour avoir des données à jour
    $_SESSION['user']=Utilisateur::getUtilisateur($dbh, $_SESSION['user']-> login);
    $user=$_SESSION['user'];
    $admin=$user->admin;
    $prenom_secure= htmlspecialchars($user->prenom);
    echo "<div class='jumbotron'><h1> Bonjour $prenom_secure</h1>";
    if ($admin){
        echo "<p>Vous êtes admin</p></div>";
        
        require 'admin/insererVideoForm.php';
        require 'admin/rendreAdminForm.php';
        require 'admin/ajouterCagnotteForm.php';
        require 'admin/effectuerTirage.php';
    }
    else {
        echo "<p>Vous êtes joueur</p></div>";
        $notif=$user->notification;
        $solde = $user->solde;
        $tickets = $user->tickets;
        if($notif){
            Utilisateur::incrementNotif($dbh,$user->login,0);
         echo <<<FIN
        
        <div class="row cadre_transparent">
            <p>Bravo ! Vous avez gagné au Lotopub</p>
        </div>      
FIN;
        }
        echo <<<FIN
        
        <div class="row cadre_transparent">
            <div class="col-md-4 col-md-offset-2">
                <p>Tickets</p>
                <p>$tickets <span class="glyphicons glyphicons-ticket"></span></p>
            </div>
            <div class="col-md-4">
                <p>Solde</p>
                <p>$solde €</p>
            </div>
        </div>      
FIN;
         
    }
    echo <<<FIN
        <div class="row cadre_transparent">
            <a role="button" class="btn btn-secondary" href="index.php?page=changePassword">Changer mon mot de passe</a>
            <a role="button" class="btn btn-secondary" href="index.php?page=deleteUser">Supprimer mon compte</a>
            <a role="button" class="btn btn-secondary" href="index.php?todo=logout">Deconnexion</a>
        </div>
    
FIN;
    ?>
</div>

