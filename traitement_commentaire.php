<?php 
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$id_billet = $_GET['id'];
$req = $bdd->prepare('INSERT INTO commentaires( id, id_billet, auteur, commentaire, date_commentaire) VALUES(NULL, :id_billet, :auteur, :commentaire, now())');
$req->execute(array(
    'id_billet' => $id_billet,
    'auteur' => htmlspecialchars($_POST['auteur_commentaire']),
    'commentaire' => htmlspecialchars($_POST['text_commentaire']),
    // 'date_commentaire' => curdate()
	));


header('Location: commentaires.php?id=' . $id_billet .'');
?>