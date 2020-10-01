<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mauvais identifiants</title>
</head>

<body>
    <a href="index.php">Accueil</a>
    <a href="inscription.php">Inscrit toi !!!</a>
    <a href="connexion.php">Connect toi !!!</a>
    <?php

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    // Récupération de l'id et du mot de passe (hashé) de l'utilisateur
    $req = $bdd->prepare('SELECT id, pseudo, mot_de_passe, mail FROM membres WHERE pseudo = :pseudo');
    $req->execute(array(
        'pseudo' => $pseudo
    ));

    $resultat = $req->fetch();

    // Comparaison du mot de passe envoyé par la BDD a celui renseigné par l'utilisateur
    $isPasswordCorrect = password_verify($password, $resultat['mot_de_passe']);

    if (!$resultat) {
        echo "Mauvais identifiant ou mot de passe";
    } else {
        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['pseudo'] = $resultat['pseudo'];
            $_SESSION['mail'] = $resultat['mail'];
            header('Location: index.php');
        } else {
            echo "Mauvais identifiant ou mot de passe";
        }
    }
    ?>
</body>

</html>