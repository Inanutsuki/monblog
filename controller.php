<?php
require 'model.php';

function listPosts()
{
    $postManager = new PostManager();
    $articles = [];
    $getPage = (isset($_GET['page']) ? ($_GET['page']) - 1 : 0);
    $nbPage = $postManager->getArticles($articles, $getPage);
    $posts = $postManager->getArticles($articles, $getPage);
    require('affichage_index.php');
}

function post()
{
    $id_billet = $_GET['id'];
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require 'affichage_commentaire.php';
}

function startSession($id, $pseudo, $mail)
{
    $_SESSION['id'] = $id;
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['mail'] = $mail;
}

function connect()
{
    $errorMsg = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pseudo = $_POST['pseudo'];
        $connectManager = new ConnectManager();
        $resultat = $connectManager->connexion($pseudo);
        $password = $_POST['password'];
        $isPasswordCorrect = $connectManager->passworChecked($pseudo, $password);
        try {
            if ($resultat) {
                if ($isPasswordCorrect == true) {
                    $_SESSION['id'] = $resultat['id'];
                    $_SESSION['pseudo'] = $resultat['pseudo'];
                    $_SESSION['mail'] = $resultat['mail'];
                    startSession($resultat['id'], $resultat['pseudo'], $resultat['mail']);
                    header('Location: index.php?action=listPosts');
                } else {
                    throw new Exception('Mauvais identifiant ou mot de passe');
                }
            } else {
                throw new Exception('Mauvais identifiant ou mot de passe');
            }
        } catch (Exception $err) {
            $errorMsg = $err->getMessage();
        }
    }

    require('affichage_connexion.php');
}

function newInscription()
{
    $inscriptionManager = new InscriptionManager();
    $errorMsg = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $password = $_POST['password'];
        $passwordCopy = htmlspecialchars($_POST['passwordCopy']);

        try {
            $subscribed = $inscriptionManager->inscription($pseudo, $mail, $password, $passwordCopy);

            if ($subscribed) {
                header('Location: index.php');
            } else {
                throw new Exception('Erreur lors de l\'inscription.', 500);
            }
        } catch (Exception $err) {
            $errorMsg = $err->getMessage();
        }
    }

    require('affichage_inscription.php');
}

function addComment()
{
    $id_billet = $_GET['id'];
    $comment = htmlspecialchars($_POST['text_commentaire']);
    $author = htmlspecialchars($_POST['auteur_commentaire']);
    $commentManager = new CommentManager();
    $commentManager->insertComment($author, $comment, $id_billet);
}

function updateComments()
{
    $id_billet = $_GET['id'];
    $commentManager = new CommentManager();
    $idcomment = $commentManager->getCommentInfos($_GET['thiscomment']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updatedComment = htmlspecialchars($_POST['upadted_comment']);
        if (!empty($_POST['upadted_comment'])) {
            $commentManager = new CommentManager();
            $commentManager->updateComment($idcomment, $updatedComment, $id_billet);
        } else {
            throw new Exception('Vous n\'avez pas rempli le champ commentaire.');
        }
    }
    require('update_comment.php');
}
