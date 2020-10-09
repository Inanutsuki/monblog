<?php
$title = "Commentaire";
$id_billet = $_GET['id'];
ob_start();
?>
<div class="container">

    <?php
    if ($post != false) {
        echo '<h1>' . $post['titre'] . '</h1>';

        echo '<div class="date">Ecrit le : ' . $post['date_creation'] . '</div>';
        echo '<article>' . $post['contenu'] . '</article>';
        echo '<p>Commentaires :</p>';
    } else {
        echo "Désolé petit malin !!!";
    }
    foreach ($comments as $comment) {
        if (isset($_SESSION['pseudo']) === $comment['auteur']) {
            echo '<p>' . $comment['commentaire'] . '</p>';
            echo '<p class="comment">Auteur du commentaire : ' . $comment['auteur'] . ' - Commenté le ' . $comment['date_commentaire'] . ' <a href="index.php?action=updateComment&amp;thiscomment=' . $comment['id'] . '&id=' . $id_billet . '" class="d-inline-block">Modififer</a></p>';
        } else {
            echo '<p>' . $comment['commentaire'] . '</p>';
            echo '<p class="comment">Auteur du commentaire : ' . $comment['auteur'] . ' - Commenté le ' . $comment['date_commentaire'] . ' </p>';
        }
    }

    ?>
</div>
<form method="post" action="<?php echo 'index.php?action=form-comment&id=' . $id_billet . ''  ?>">
    <div class="form-group col-4">
        <?php
        if (!empty($errorMsg)) {
        ?>
            <div class="alert alert-warning">
                <?= $errorMsg; ?>
            </div>
        <?php
        }
        ?>
        <label for="auteur_commentaire">Votre nom et prénom :</label>
        <input type="text" name="auteur_commentaire" class="form-control" id="auteur_commentaire">
    </div>
    <div class="form-group ml-3">
        <label for="text_commentaire">Votre commentaire :</label>
        <textarea name="text_commentaire" class="form-control" id="text_commentaire" rows="3"></textarea>
        <button type="submit" class="btn btn-primary mt-4" name="form-comment">envoyer</button>
    </div>
</form>

<?php
$content = ob_get_clean();
require('template.php');
?>