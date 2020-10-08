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
            $postManager = new PostManager;
            if (!empty($postManager->getpost($_GET['id']))) {
                if (!empty($_POST['auteur_commentaire'])) {
                    if (!empty($_POST['text_commentaire'])) {
                        addComment();
                    }
                }
            }
        }else if($_GET['action'] == 'updateComment'){
            updateComments();
        }
    } else {
        listPosts();
    }
} catch (Exception $e) {
    echo '<p class="text-center">Erreur : ' . $e->getMessage() . '</p>';
}
