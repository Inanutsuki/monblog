<?php
session_start();

require_once 'InscriptionManager.php';
require_once 'ConnectManager.php';
require_once 'PostManager.php';
require_once 'CommentManager.php';
require 'controller.php';

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listposts();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                require('affichage_error.php');
                throw new Exception('aucun identifiant de billet envoyé.');
            }
        } elseif ($_GET['action'] == 'connexion') {
            connect();
        } elseif ($_GET['action'] == 'inscription') {
            newInscription();
        } else if ($_GET['action'] == 'form-comment') {
            $id_billet = $_GET['id'];
            $postManager = new PostManager;
            $commentManager = new CommentManager();
            $post = $postManager->getPost($id_billet);
            $comments = $commentManager->getComments($id_billet);
            $errorMsg = "";
            if (!empty($postManager->getpost($id_billet))) {
                if (!empty($_POST['auteur_commentaire'])) {
                    if (!empty($_POST['text_commentaire'])) {
                        addComment();
                    } else {
                        $errorMsg = 'Vous n\'avez pas rempli le champ commentaire.';
                    }
                } else {
                    $errorMsg = 'Vous n\'avez pas renseigné votre nom.';
                }
                require 'affichage_commentaire.php';
            }
        } else if ($_GET['action'] == 'updateComment') {
            updateComments();
        }
    } else {
        listPosts();
    }
} catch (Exception $e) {
    echo '<p class="text-center">Erreur : ' . $e->getMessage() . '</p>';
}
