<?php
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <title>Profile de <?php echo $_SESSION['pseudo']; ?></title>
</head>

<body>
    <?php
    include 'navbar.php';



    ?>
    <div class="container">
        <form method="POST" action="traitement_inscription.php">
            <div class="form-row">
                <div class="col">
                    <label for="inputPseudo">Votre pseudo :</label>
                    <input type="text" class="form-control" id="inputPseudo" name="pseudo" value="<?php echo $pseudo=(empty($_SESSION['pseudo'])) ? '' : $_SESSION['pseudo'];?>" disabled required>
                </div>
                <div class="col">
                    <label for="inputEmail">Votre email :</label>
                    <input type="email" /*pattern=".+@globex.com"*/ class="form-control" id="inputEmail" name="mail" value="<?php echo $pseudo=(empty($_SESSION['mail'])) ? '' : $_SESSION['mail'];?>" disabled required>
                </div>
            </div>
            <div class="form-row password invisible">
                <div class="col">
                    <label for="inputPassword">Votre mot de passe :</label>
                    <input type="password" class="form-control" id="inputPassword" name="password" required>
                </div>
                <div class="col">
                    <label for="inputPasswordCopy">Verification du mot de passe :</label>
                    <input type="password" class="form-control" id="inputPasswordCopy" name="passwordCopy" placeholder="" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">envoyer</button>
            </div>
            <div class="btn btn-primary"><a href="traitement_profile.php">Editer profile</a></div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>