<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Accueil</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="connexion.php">Connnexion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="inscription.php">Inscription</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="deconnexion.php">Déconnexion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Votre profile</a>
            </li>
        </ul>
    </div>
    <p>Bonjour <?php echo $pseudo=(empty($_SESSION['pseudo'])) ? '' : $_SESSION['pseudo'];?></p>
</nav>