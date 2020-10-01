<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Les commentaires</title>
</head>

<body>

    <?php
    include 'navbar.php';
    ?>
    <div class="container">
        <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $id_billet = $_GET['id'];
        $reponse = $bdd->query('SELECT titre, contenu, date_creation FROM billets WHERE id=' . $id_billet . '');
        $donnees = $reponse->fetch();

        if ($donnees === false) {
            echo "Désolé petit malin !!!";
        } else {
            echo '<h1>' . $donnees['titre'] . '</h1>';
            echo '<div class="date">Ecrit le : ' . $donnees['date_creation'] . '</div>';
            echo '<article>' . $donnees['contenu'] . '</article>';
            echo '<p>Commentaires :</p>';
        }



        $reponse->closeCursor();



        $reponse = $bdd->query('SELECT auteur, commentaire, date_commentaire FROM commentaires WHERE id_billet =' . $id_billet . ' ORDER BY ID DESC LIMIT 0,10');

        while ($donnees = $reponse->fetch()) {
            echo '<p>' . $donnees['commentaire'] . '</p>';
            echo '<p class="comment">Auteur du commentaire : ' . $donnees['auteur'] . ' - Commenté le ' . $donnees['date_commentaire'] . ' </p>';
        }
        $reponse->closeCursor();
        ?>
    </div>
    <form method="post" action="<?php echo 'traitement_commentaire.php?id=' . $id_billet . ' ' ?>">
        <div class="form-group col-4">
            <label for="auteur_commentaire">Votre nom et prénom :</label>
            <input type="text" name="auteur_commentaire" class="form-control" id="auteur_commentaire">
        </div>
        <div class="form-group ml-3">
            <label for="text_commentaire">Votre commentaire :</label>
            <textarea name="text_commentaire" class="form-control" id="text_commentaire" rows="3"></textarea>
            <button type="submit" class="btn btn-primary mt-4">envoyer</button>
        </div>
    </form>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>