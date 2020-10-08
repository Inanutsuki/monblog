<?php

$title = "Connexion";
ob_start();
?>
<div class="container ">
    <form method="POST" action="">
    <?php
    if(!empty($errorMsg)){
        ?>
        <div class="alert alert-warning">
            <?= $errorMsg; ?>
        </div>
        <?php
    }
    ?>
        <div class="form-row d-flex justify-content-around">
            <div class="col-4">
                <label for="inputPseudo">Votre pseudo :</label>
                <input type="text" class="form-control" id="inputPseudo" name="pseudo" required>
            </div>
        </div>
        <div class="form-row d-flex justify-content-around">
            <div class="col-4">
                <label for="inputEmail">Mot de passe :</label>
                <input type="password" class="form-control" id="inputPassword" name="password" required>
            </div>
        </div>
        <?php
        if (isset($_GET['error_login'])) {
            echo '<p class="text-center">Mauvais identifiant ou mot de passe.</p>';
        }
        ?>
        <div class="form_connexion-button col-4">
            <button type="submit" class="btn btn-primary mt-4" name="form-connexion">Connecte toi !!!</button>
        </div>
    </form>
</div>
<?php 
    $content = ob_get_clean();
    require ('template.php');
?>