<?php
$title = "Modification du commentaire";
// $id_billet = $_GET['id'];
// $idcomment=$_GET['thiscomment'];
ob_start();
?>
<div class="container">
<form method="post" action="<?php echo 'index.php?action=updateComment&id=' . $id_billet . '&thiscomment='. $idcomment['id'].''  ?>">
    <div class="form-group col-4">
        <label for="auteur_commentaire">Votre nom et prénom :</label>
        <input type="text" name="auteur_commentaire" class="form-control" id="auteur_commentaire" value="<?= $_SESSION['pseudo']; ?>" disabled>
    </div>
    <div class="form-group ml-3">
        <label for="upadted_comment">Votre commentaire :</label>
        <textarea name="upadted_comment" class="form-control" id="upadted_comment" rows="3"></textarea>
        <button type="submit" class="btn btn-primary mt-4" name="form-comment">envoyer</button>
    </div>
</form>
</div>
<?php 
$content = ob_get_clean();
require 'template.php';
?>