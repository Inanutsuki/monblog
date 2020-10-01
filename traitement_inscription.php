<?php
try {
    // $bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root', '');
} catch (Exception $e) {
    // die('Erreur : ' . $e->getMessage());
}
// Verification des données pour l'inscription
$pseudo = htmlspecialchars($_POST['pseudo']);
$password = $_POST['password'];
$passwordCopy = htmlspecialchars($_POST['passwordCopy']);
$mail = htmlspecialchars($_POST['mail']);

// Hashage du mot de passe
$pass_hash = password_hash($password, PASSWORD_DEFAULT);



// Récupération de l'id et du mot de passe (hashé) de l'utilisateur



$reponse_mail = $bdd->prepare('SELECT * FROM membres WHERE mail = :mail');
$reponse_pseudo = $bdd->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');

$reponse_mail->execute(array(
    'mail' => $mail
));

$reponse_pseudo->execute(array(
    'pseudo' => $pseudo
));

$donnees_mail = $reponse_mail->fetch();
$donnees_pseudo = $reponse_pseudo->fetch();

if (empty($donnees_pseudo['pseudo'])) {
    if (empty($donnees_mail['mail'])) {
        if ($password == $passwordCopy) {
            $req = $bdd->prepare('INSERT INTO membres(pseudo, mot_de_passe, mail, date_inscription) VALUE(:pseudo, :mypassword, :mail, now())');
            $req->execute(array(
                'pseudo' =>  $pseudo,
                'mypassword' =>  $pass_hash,
                'mail' =>  $mail
            ));
            header('Location: index.php');
        } else {
            header('Location: inscription.php?erreur');
        }
    } else {
        header('Location: inscription.php?bad_mail');
    }
} else {
    header('Location: inscription.php?pseudo');
}

$reponse->closeCursor();
