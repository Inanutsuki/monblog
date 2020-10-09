<?php
require 'model.php';
require_once 'PostManager.php';
require_once 'CommentManager.php';

$postManager = new PostManager();
$commentManager = new CommentManager();

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    require('affichage_commentaire.php');
}
