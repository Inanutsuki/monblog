<?php
// $bdd = NULL;
// function dbConnect()
// {
//     global $bdd;
//     if(empty($bdd)){
//         try {
//             $bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//         } catch (Exception $e) {
//             die('Erreur : ' . $e->getMessage());
//         }
//     }

//     return $bdd;
// }

// function getArticles(&$articles)
// {
//     $bdd = dbConnect();
//     $nbBillets = $bdd->query('SELECT COUNT(*) AS nb_billet FROM billets');
//     $responsCount = $nbBillets->fetch();
//     $limitArticle = 5;
//     $totalArticle = $responsCount['nb_billet'];
//     $getPage = (isset($_GET['page']) ? ($_GET['page']) - 1 : 0);
//     $numPage = $limitArticle * $getPage;
//     $nbPage = ceil($totalArticle / $limitArticle);
//     $respons = $bdd->query('SELECT id, titre, contenu, date_creation FROM billets ORDER BY ID LIMIT ' . $limitArticle . ' OFFSET ' . $numPage);
    
//     $articles = $respons->fetchAll();

//     return $nbPage;
// }

// function getPost($id_billet)
// {
//     $bdd = dbConnect();
//     $req = $bdd->prepare('SELECT titre, contenu, date_creation FROM billets WHERE id=' . $id_billet . '');
//     $req->execute(array());
//     $post = $req->fetch();
//     return $post;
// }

// function getComments($id_billet)
// {
//     $bdd = dbConnect();
//     $comments = $bdd->prepare('SELECT auteur, commentaire, date_commentaire FROM commentaires WHERE id_billet = ? ORDER BY ID DESC LIMIT 0,10');
//     $comments->execute(array($id_billet));
//     return $comments;
// }

// function insertComment()
// {
//     $bdd = dbConnect();
//     $id_billet = $_GET['id'];
//     $comment = htmlspecialchars($_POST['text_commentaire']);
//     $author = htmlspecialchars($_POST['auteur_commentaire']);
//     $req = $bdd->prepare('INSERT INTO commentaires( id, id_billet, auteur, commentaire, date_commentaire) VALUES(NULL, :id_billet, :auteur, :commentaire, now())');
//     $req->execute(array(
//         'id_billet' => $id_billet,
//         'auteur' => $author,
//         'commentaire' => $comment,
//     ));
//     header('Location: commentaires.php?id=' . $id_billet . '');
// }

// function connexion()
// {
//     $bdd = dbConnect();
//     $pseudo = $_POST['pseudo'];

//     $req = $bdd->prepare('SELECT id, pseudo, mot_de_passe, mail FROM membres WHERE pseudo = :pseudo');
//     $req->execute(array(
//         'pseudo' => $pseudo
//     ));

//     $resultat = $req->fetch();


//     return $resultat;
// }

// function check_inscription($pseudo, $mail)
// {
//     $bdd = dbConnect();

//     $reponse_mail = $bdd->prepare('SELECT * FROM membres WHERE mail = :mail');
//     $reponse_pseudo = $bdd->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');

//     $reponse_mail->execute(array(
//         'mail' => $mail
//     ));

//     $reponse_pseudo->execute(array(
//         'pseudo' => $pseudo
//     ));

//     $donnees_mail = $reponse_mail->fetch();
//     $donnees_pseudo = $reponse_pseudo->fetch();

//     return [$donnees_pseudo, $donnees_mail, $pseudo, $mail, $bdd];
// }



// function inscription($pseudo, $mail, $password, $passwordCopy){
    

//     $pass_hash = password_hash($password, PASSWORD_DEFAULT);

//     [$donnees_pseudo, $donnees_mail, $pseudo, $mail, $bdd] = check_inscription($pseudo, $mail);

//     if (empty($donnees_pseudo['pseudo'])) {
//         if (empty($donnees_mail['mail'])) {
//             if ($password == $passwordCopy) {
//                 $req = $bdd->prepare('INSERT INTO membres(pseudo, mot_de_passe, mail, date_inscription) VALUE(:pseudo, :mypassword, :mail, now())');
//                 $req->execute(array(
//                     'pseudo' =>  $pseudo,
//                     'mypassword' =>  $pass_hash,
//                     'mail' =>  $mail
//                 ));
//                 connect();
//                 return true;
//             } else {
//                 throw new Exception('Vos mots de passe ne sont pas les mêmes.');;
//             }
//         } else {
//             throw new Exception('Cette email existe déjà.');;
//         }
//     } else {
//         throw new Exception('Ce pseudo existe déjà.');
//     }

//     return false;
// }