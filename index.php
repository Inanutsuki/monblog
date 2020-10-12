<?php
session_start();

require_once 'ControllerManager.php';
require_once 'InscriptionManager.php';
require_once 'ConnectManager.php';
require_once 'PostManager.php';
require_once 'CommentManager.php';
require_once 'controller.php';
$controller = new Controller();
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $controller->listposts();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller->post();
            } else {
                require('affichage_error.php');
                throw new Exception('aucun identifiant de billet envoyé.');
            }
        } elseif ($_GET['action'] == 'connexion') {
            $controller->connect();
        } elseif ($_GET['action'] == 'inscription') {
            $controller->newInscription();
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
                        $controller->addComment();
                    } else {
                        $errorMsg = 'Vous n\'avez pas rempli le champ commentaire.';
                    }
                } else {
                    $errorMsg = 'Vous n\'avez pas renseigné votre nom.';
                }
                require 'affichage_commentaire.php';
            }
        } else if ($_GET['action'] == 'updateComment') {
            $controller->updateComments();
        }
    } else {
        $controller->listPosts();
    }
} catch (Exception $e) {
    echo '<p class="text-center">Erreur : ' . $e->getMessage() . '</p>';
}
