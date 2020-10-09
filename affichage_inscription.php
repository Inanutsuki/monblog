<?php

$title = "Inscription";
ob_start();

?>
<div class="container">
    <form method="POST" action="index.php?action=inscription">

    <?php
    if(!empty($errorMsg)){
        ?>
        <div class="alert alert-warning">
            <?= $errorMsg; ?>
        </div>
        <?php
    }
    ?>

        <div class="form-row">
            <div class="col">
                <label for="inputPseudo">Votre pseudo :</label>
                <input type="text" class="form-control" id="inputPseudo" name="pseudo" required>
            </div>
            <div class="col">
                <label for="inputEmail">Votre email :</label>
                <input type="email" pattern="[a-zA-Z0-9.!#$%&amp;’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+" class="form-control" id="inputEmail" name="mail" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="inputPassword">Votre mot de passe :</label>
                <input type="password" class="form-control" id="inputPassword" name="password" required>
            </div>
            <div class="col">
                <label for="inputPasswordCopy">Verification du mot de passe :</label>
                <input type="password" class="form-control" id="inputPasswordCopy" name="passwordCopy" placeholder="" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-4" name="form-inscription">envoyer</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require ('template.php');
?>